<?php

namespace App\Models;

use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property int $id
 * @property int|null $address_id
 * @property int|null $department_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string|null $designation
 * @property string $phone
 * @property int $gender
 * @property string|null $education
 * @property string $dob
 * @property int $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read string $full_name
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 *
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAddressId($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereDepartmentId($value)
 * @method static Builder|User whereDesignation($value)
 * @method static Builder|User whereDob($value)
 * @method static Builder|User whereEducation($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 *
 * @property string|null $blood_group
 * @property int|null $owner_id
 * @property string|null $owner_type
 * @property-read mixed $image_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User|null $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Department[] $roles
 * @property-read int|null $roles_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User userRolerole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBloodGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereOwnerType($value)
 *
 * @property string|null $qualification
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $language
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereQualification($value)
 *
 * @property int $is_default
 * @property string|null $stripe_id
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $trial_ends_at
 * @property-read \App\Models\Department|null $department
 * @property-read mixed $age
 * @property-read \App\Models\Patient|null $patient
 *
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User whereCardBrand($value)
 * @method static Builder|User whereCardLastFour($value)
 * @method static Builder|User whereIsDefault($value)
 * @method static Builder|User whereStripeId($value)
 * @method static Builder|User whereTrialEndsAt($value)
 */
class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasFactory, Notifiable, InteractsWithMedia, HasRoles, HasApiTokens;

    const COLLECTION_PROFILE_PICTURES = 'profile_photo';

    const COLLECTION_MAIL_ATTACHMENTS = 'mail_attachments';

    const STATUS_ALL = 2;

    const ACTIVE = 0;

    const INACTIVE = 1;

    const STATUS_ARR = [
        self::ACTIVE => 'Active',
        self::INACTIVE => 'InActive',
    ];

    const FILTER_STATUS_ARR = [
        0 => 'All',
        1 => 'Active',
        2 => 'Deactive',
    ];

    const FILTER_Role_ARR = [
    ];

    const THEME_DARK_MODE = 1;

    const THEME_LIGHT_MODE = 0;

    const LANGUAGES = [
        'ar' => 'Arabic',
        'zh' => 'Chinese',
        'en' => 'English',
        'fr' => 'French',
        'de' => 'German',
        'pt' => 'Portuguese',
        'ru' => 'Russian',
        'es' => 'Spanish',
        'tr' => 'Turkish',
    ];

    const MAIN_IPD_OPD = 'IPD_OPD';

    const MAIN_BED_MGT = 'MAIN_BED_MGT';

    const MAIN_BILLING_MGT = 'MAIN_BILLING_MGT';

    const MAIN_BLOOD_BANK_MGT = 'MAIN_BLOOD_BANK_MGT';

    const MAIN_DOCUMENT = 'MAIN_DOCUMENT';

    const MAIN_DOCTOR = 'MAIN_DOCTOR';

    const MAIN_DIAGNOSIS = 'MAIN_DIAGNOSIS';

    const MAIN_FINANCE = 'MAIN_FINANCE';

    const MAIN_FRONT_OFFICE = 'MAIN_FRONT_OFFICE';

    const MAIN_HOSPITAL_CHARGE = 'MAIN_HOSPITAL_CHARGE';

    const MAIN_INVENTORY = 'MAIN_INVENTORY';

    const MAIN_LIVE_CONSULATION = 'MAIN_LIVE_CONSULATION';

    const MAIN_MEDICINES = 'MAIN_MEDICINES';

    const MAIN_PATIENT_CASE = 'MAIN_PATIENT_CASE';

    const MAIN_PATHOLOGY = 'MAIN_PATHOLOGY';

    const MAIN_REPORT = 'MAIN_REPORT';

    const MAIN_RADIOLOGY = 'MAIN_RADIOLOGY';

    const MAIN_SERVICE = 'MAIN_SERVICE';

    const MAIN_SMS_MAIL = 'MAIN_SMS_MAIL';

    const MAIN_DOCTOR_BED_MGT = 'MAIN_DOCTOR_BED_MGT';

    const MAIN_DOCTOR_PATIENT_CASE = 'MAIN_DOCTOR_PATIENT_CASE';

    const MAIN_CASE_MANGER_PATIENT_CASE = 'MAIN_CASE_MANGER_PATIENT_CASE';

    const MAIN_CASE_MANGER_SERVICE = 'MAIN_CASE_MANGER_SERVICE';

    const MAIN_ACCOUNT_MANAGER_MGT = 'MAIN_ACCOUNT_MANAGER_MGT';

    const MAIN_VACCINATION_MGT = 'MAIN_VACCINATION_MGT';

    const LANGUAGES_IMAGE = [
        'ar' => 'assets/img/iraq.svg',
        'zh' => 'assets/img/china.svg',
        'en' => 'assets/img/united-states.svg',
        'fr' => 'assets/img/france.svg',
        'de' => 'assets/img/germany.svg',
        'pt' => 'assets/img/portugal.svg',
        'ru' => 'assets/img/russia.svg',
        'es' => 'assets/img/spain.svg',
        'tr' => 'assets/img/turkey.svg',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_id',
        'department_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'designation',
        'phone',
        'gender',
        'qualification',
        'dob',
        'blood_group',
        'status',
        'language',
        'owner_id',
        'owner_type',
        'email_verified_at',
        'updated_at',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedIn_url',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'email' => 'required|email:filter|unique:users,email',
        'password' => 'nullable|same:password_confirmation|min:6',
        'department_id' => 'required|string',
        'gender' => 'required|string',
        'dob' => 'nullable|date',
        'phone' => 'required|numeric',
        'address1' => 'nullable|string',
        'address2' => 'nullable|string',
        'city' => 'nullable|string',
        'zip' => 'nullable|integer',
        'image' => 'nullable|mimes:jpg,jpeg,png',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const IMG_COLUMN = 'image_url';

    /**
     * @var array
     */
    protected $appends = ['full_name', 'age', 'image_url', 'api_image_url'];

    /**
     * @var array
     */
    public static $messages = [
        'phone.digits' => 'The phone number must be 10 digits long.',
        'email.regex' => 'Please enter valid email.',
        'photo.mimes' => 'The profile image must be a file of type: jpeg, jpg, png.',
    ];

    /**
     * @return array
     */
    public function prepareData(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name ?? 'N/A',
            'last_name' => $this->last_name ?? 'N/A',
            'email' => $this->email ?? 'N/A',
            'phone_number' => $this->phone ?? 'N/A',
            'image_url' => $this->getApiImageUrlAttribute() ?? 'N/A',
        ];
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }

    /**
     * @return mixed
     */
    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::COLLECTION_PROFILE_PICTURES)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return getUserImageInitial($this->id, $this->full_name);
    }

    /**
     * Accessor for Age.
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    /**
     * @return MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * @param  array  $ownerType
     * @return string
     */
    public static function getOwnerType($ownerType)
    {
        switch ($ownerType) {
            case Accountant::class:
                return Notification::ACCOUNTANT;
            case Patient::class:
                return Notification::PATIENT;
            case Doctor::class:
                return Notification::DOCTOR;
            case Receptionist::class:
                return Notification::RECEPTIONIST;
            case CaseHandler::class:
                return Notification::CASE_HANDLER;
            case LabTechnician::class:
                return Notification::LAB_TECHNICIAN;
            case Nurse::class:
                return Notification::NURSE;
            case Pharmacist::class:
                return Notification::PHARMACIST;
            default:
                return Notification::ADMIN;
        }
    }

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    /**
     * @return HasOne
     */
    public function patient(): HasOne
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * @return HasOne
     */
    public function admin(): HasOne
    {
        return $this->hasOne(admin::class);
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function getGenderStringAttribute()
    {
        if ($this->gender == 0) {
            return __('messages.user.male');
        } else {
            return __('messages.user.female');
        }
    }

    public function userRole(): array
    {
        $role = Department::orderBy('name')->pluck('name', 'id')->toArray();

        return $role;
    }

    /**
     * @return mixed
     */
    public function getApiImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::COLLECTION_PROFILE_PICTURES)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return getApiUserImageInitial($this->id, $this->first_name);
    }
}
