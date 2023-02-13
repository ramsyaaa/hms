<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserAPIController
 */
class UserAPIController extends AppBaseController
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * @param  UserRepository  $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return JsonResponse
     */
    public function editProfile(): JsonResponse
    {
        $user = Auth::user();
        $userData = new ProfileResource($user);

        return $this->sendResponse($userData, 'Profile Data Retrieved successfully.');
    }

    /**
     * @param  UpdateUserProfileRequest  $request
     * @return JsonResponse
     */
    public function updateProfile(UpdateUserProfileRequest $request): JsonResponse
    {
        $input = $request->all();
        $updateUser = $this->userRepository->profileApiUpdate($input);
        $newData = new ProfileResource($updateUser);

        return $this->sendResponse($newData, 'Profile Updated successfully');
    }

    /**
     * @param  ChangePasswordRequest  $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $input = $request->all();
        try {
            $this->userRepository->changePassword($input);

            return $this->sendSuccess('Password updated successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile(): JsonResponse
    {
        $user = User::where('id', getLoggedInUserId())->first();

        return $this->sendResponse($user->prepareData(), 'User profile get successfully');
    }
}
