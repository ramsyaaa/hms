<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends AppBaseController
{
    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if (empty($email) or empty($password)) {
            return $this->sendError('username and password required', 422);
        }
        $user = User::whereRaw('lower(email) = ?', [$email])->first();

        if (empty($user)) {
            return $this->sendError('Invalid username or password', 422);
        }

        if (! Hash::check($password, $user->password)) {
            return $this->sendError('Invalid username or password', 422);
        }

        $token = $user->createToken('token')->plainTextToken;
        $user->last_name = $user->last_name ?? '';
        if ($user->hasRole('Doctor')) {
            $data = [
                'token' => $token,
                'is_doctor' => true,
                'user' => $user->prepareData(),
            ];
        } else {
            $data = [
                'token' => $token,
                'is_doctor' => false,
                'user' => $user->prepareData(),
            ];
        }

        return $this->sendResponse($data, 'Logged in successfully.');
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->where('id', Auth::user()->currentAccessToken()->id)->delete();

        return $this->sendSuccess('Logout Successfully');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function sendPasswordResetLinkEmail(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $data['user'] = User::whereEmail($request->email)->first();

        if (! $data['user']) {
            return $this->sendError('We can\'t find user with this email address');
        }

        $data['token'] = encrypt($data['user']->email.''.$data['user']->id);

        $data['link'] = 'https://infyhmsflutter.page.link/?link=http://com.example.infyhms_flutter/'.$data['token'].'&apn=com.example.infyhms_flutter';

        Mail::to($data['user']->email)
            ->send(new ForgotPasswordMail('emails.forgot_password',
                'Reset Password Notification',
                $data));

        $user = DB::table('password_resets')->where('email', $request->email)->first();

        if ($user) {
            DB::table('password_resets')->where('email', $user->email)->update([
                'email' => $request->email,
                'token' => $data['token'],
                'created_at' => Carbon::now(),
            ]);
        } else {
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $data['token'],
                'created_at' => Carbon::now(),
            ]);
        }

        return $this->sendSuccess('We have e-mailed your password reset link!');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();

        if (! $tokenData) {
            return $this->sendError('This password reset token is invalid.');
        }

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return $this->sendError('We can\'t find user with this email.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')
            ->where('token', $request->token)->delete();

        return $this->sendSuccess('Password reset successfully.');

//        $status = Password::reset(
//            $input,
//            function ($user, $password) use ($request) {
//                $user->forceFill([
//                    'password' => Hash::make($password),
//                ])->setRememberToken(Str::random(60));
//
//                $user->save();
//
//                event(new PasswordReset($user));
//            }
//        );
//
//        if ($status == Password::PASSWORD_RESET) {
//            return response()->json(['message' => __($status)], 200);
//        } else {
//            throw ValidationException::withMessages([
//                'email' => __($status),
//            ]);
//        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! Hash::check($request->old_password, $user->password)) {
            return $this->sendError('please enter correct old password');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return $this->sendSuccess('password updated');
    }
}
