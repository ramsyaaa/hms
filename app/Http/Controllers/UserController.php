<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Department;
use App\Models\DoctorDepartment;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use DB;
use Exception;
use Flash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;
use URL;

/**
 * Class UserController
 */
class UserController extends AppBaseController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @param  ChangePasswordRequest  $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $input = $request->all();

        try {
            $user = $this->userRepository->changePassword($input);

            return $this->sendSuccess(__('messages.user.password').' '.__('messages.common.updated_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @param  UpdateUserProfileRequest  $request
     * @return JsonResponse
     */
    public function profileUpdate(UpdateUserProfileRequest $request)
    {
        $input = $request->all();

        try {
            $user = $this->userRepository->profileUpdate($input);

            return $this->sendResponse($user, __('messages.common.profile').' '.__('messages.common.updated_successfully'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified User.
     *
     * @return JsonResponse
     */
    public function editProfile()
    {
        $user = getLoggedInUser()->append('image_url');

        return $this->sendResponse($user, 'User retrieved successfully.');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function updateLanguage(Request $request)
    {
        $language = $request->get('language');

        /** @var User $user */
        $user = $request->user();
        $user->update(['language' => $language]);

        return $this->sendSuccess(__('messages.profile.language').' '.__('messages.common.updated_successfully'));
    }

    /**
     * @param  Request  $request
     * @return Application|Factory|View
     *
     * @throws Exception
     */
    public function index()
    {
        $roles = Department::orderBy('name')->pluck('name', 'id')->toArray();
        $status = User::STATUS_ARR;

        return view('users.index', compact('roles', 'status'));
    }

    public function create()
    {
        $isEdit = false;
        $role = Department::orderBy('name')->pluck('name', 'id')->toArray();
        $doctorDepartments = DoctorDepartment::pluck('title', 'id')->toArray();

        return view('users.create', compact('isEdit', 'role', 'doctorDepartments'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  CreateUSerRequest  $request
     * @return RedirectResponse|Redirector
     *
     * @throws Throwable
     */
    public function store(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['status'] = isset($input['status']) ? 1 : 0;
            $this->userRepository->store($input);
            Flash::success(__('messages.users').' '.__('messages.common.saved_successfully'));
            DB::commit();

            return redirect(route('users.index'));
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $user
     * @return Application|Factory|View
     */
    public function show($user)
    {
        $userData = $this->userRepository->getUserData($user);

        return view('users.show', compact('userData'));
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  User  $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $role = Department::pluck('name', 'id')->all();
        $isEdit = true;

        return view('users.edit', compact('isEdit', 'user', 'role'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
        $input['phone'] = preparePhoneNumber($input, 'phone');
        $this->userRepository->updateUser($input, $user->id);
        Flash::success(__('messages.users').' '.__('messages.common.updated_successfully'));

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $this->userRepository->deleteUser($user->id);

        return $this->sendSuccess(__('messages.users').' '.__('messages.common.deleted_successfully'));
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $user = User::findOrFail($id);
        $status = ! $user->status;
        $user->update(['status' => $status]);

        return $this->sendSuccess(__('messages.common.status_updated_successfully'));
    }

    /**
     * @param $user
     * @return JsonResponse
     */
    public function showModal($user)
    {
        $userData = $this->userRepository->getUserData($user);

        return $this->sendResponse($userData, 'User Retrieved Successfully.');
    }

    /**
     * @param  int  $id
     * @return JsonResponse
     */
    public function isVerified($id)
    {
        $user = User::findOrFail($id);
        $emailVerified = $user->email_verified_at == null ? Carbon::now() : null;
        $user->update(['email_verified_at' => $emailVerified]);

        return $this->sendSuccess(__('messages.user.email_verified_successfully'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function changeThemeMode()
    {
        $user = User::find(getLoggedInUser()->id);

        if ($user->thememode == User::THEME_LIGHT_MODE) {
            $user['thememode'] = User::THEME_DARK_MODE;
        } else {
            $user['thememode'] = User::THEME_LIGHT_MODE;
        }

        $user->update();

        return redirect(URL::previous());
    }
}
