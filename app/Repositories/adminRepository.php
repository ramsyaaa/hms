<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\admin;
use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class adminRepository
 *
 * @version September 26, 2022, 9:47 pm UTC
 */
class adminRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function store($input, $mail = true)
    {
        try {
            $input['department_id'] = Department::whereName('Admin')->first()->id;
            $input['password'] = Hash::make($input['password']);
            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            $input['email_verified_at'] = Carbon::now();
            $user = User::create($input);
//            if ($mail) {
//                $user->sendEmailVerificationNotification();
//            }

            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = storeProfileImage($user, $input['image']);
            }
            $admin = Admin::create(['user_id' => $user->id]);
            $ownerId = $admin->id;
            $ownerType = Admin::class;

            if (! empty($address = Address::prepareAddressArray($input))) {
                Address::create(array_merge($address, ['owner_id' => $ownerId, 'owner_type' => $ownerType]));
            }

            $user->update(['owner_id' => $ownerId, 'owner_type' => $ownerType]);
            $user->assignRole($input['department_id']);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($admin, $input)
    {
        try {
//            $user = User::find($admin->user->id);
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && ! empty($input['avatar_remove'])) {
                removeFile($admin, User::COLLECTION_PROFILE_PICTURES);
            }
            if (isset($input['image']) && ! empty($input['image'])) {
                $mediaId = updateProfileImage($admin, $input['image']);
            }

            $input['phone'] = preparePhoneNumber($input, 'phone');
            $input['dob'] = (! empty($input['dob'])) ? $input['dob'] : null;
            $admin->update($input);
//            $admin->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
