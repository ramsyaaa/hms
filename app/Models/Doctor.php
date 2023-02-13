<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * Class Doctor
 *
 * @version February 13, 2020, 8:55 am UTC
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $doctorUser
 *
 * @method static Builder|Doctor newModelQuery()
 * @method static Builder|Doctor newQuery()
 * @method static Builder|Doctor query()
 * @method static Builder|Doctor whereCreatedAt($value)
 * @method static Builder|Doctor whereId($value)
 * @method static Builder|Doctor whereSpecialist($value)
 * @method static Builder|Doctor whereUpdatedAt($value)
 * @method static Builder|Doctor whereUserId($value)
 * @mixin Model
 *
 * @property int $user_id
 * @property int $department_id
 * @property string $specialist
 * @property-read Address $address
 *
 * @method static Builder|Doctor whereDepartmentId($value)
 *
 * @property int $doctor_department_id
 *
 * @method static Builder|Doctor whereDoctorDepartmentId($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PatientCase[] $cases
 * @property-read int|null $cases_count
 * @property-read \App\Models\DoctorDepartment $department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read int|null $patients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EmployeePayroll[] $payrolls
 * @property-read int|null $payrolls_count
 * @property int $is_default
 *
 * @method static Builder|Doctor whereIsDefault($value)
 */
class Doctor extends Model
{
    public $table = 'doctors';

    public $fillable = [
        'user_id',
        'doctor_department_id',
        'specialist',
    ];

    const STATUS_ALL = 2;

    const ACTIVE = 0;

    const INACTIVE = 1;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE => 'Active',
        self::INACTIVE => 'Deactive',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'doctor_department_id' => 'integer',
        'specialist' => 'string',
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
        'designation' => 'required|string',
        'gender' => 'required',
        'qualification' => 'required|string',
        'dob' => 'nullable|date',
        'specialist' => 'required|string',
        'address1' => 'nullable|string',
        'address2' => 'nullable|string',
        'city' => 'nullable|string',
        'zip' => 'nullable|integer',
    ];

    /**
     * @return array
     */
    public function prepareDoctorData(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->user->full_name,
        ];
    }

    /**
     * @return BelongsTo
     */
    public function doctorUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'owner');
    }

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(DoctorDepartment::class, 'doctor_department_id');
    }

    /**
     * @return HasMany
     */
    public function cases()
    {
        return $this->hasMany(PatientCase::class, 'doctor_id');
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_cases', 'doctor_id', 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    /**
     * @return HasMany
     */
    public function schedules()
    {
        return $this->hasMany(ScheduleDay::class, 'doctor_id');
    }

    /**
     * @return MorphMany
     */
    public function payrolls()
    {
        return $this->morphMany(EmployeePayroll::class, 'owner');
    }

    /**
     * @return array
     */
    public function prepareDoctor(): array
    {
        return [
            'id' => $this->id,
            'doctor_name' => $this->doctorUser->full_name ?? 'N/A',
            'doctor_department' => $this->department->title,
            'doctor_image' => $this->doctorUser->getApiImageUrlAttribute(),
        ];
    }

    /**
     * @return array
     */
    public function prepareDoctorDetail(): array
    {
        return [
            'id' => $this->id,
            'doctor_name' => $this->doctorUser->full_name ?? 'N/A',
            'email' => $this->doctorUser->email ?? 'N/A',
            'phone' => $this->doctorUser->phone ?? 'N/A',
            'designation' => $this->doctorUser->designation ?? 'N/A',
            'doctor_department' => $this->department->title ?? 'N/A',
            'qualification' => $this->doctorUser->qualification ?? 'N/A',
            'blood_group' => $this->doctorUser->blood_group ?? 'N/A',
            'date_of_birth' => $this->doctorUser->dob ?? 'N/A',
            'gender' => $this->doctorUser->getGenderStringAttribute() ?? 'N/A',
            'specialist' => $this->specialist ?? 'N/A',
            'address1' => $this->address->address1 ?? 'N/A',
            'address2' => $this->address->address2 ?? 'N/A',
            'city' => $this->address->city ?? 'N/A',
            'zip' => $this->address->zip ?? 'N/A',
        ];
    }
}
