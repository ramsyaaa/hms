<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Appointment
 *
 * @version February 13, 2020, 5:52 am UTC
 *
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property int $department_id
 * @property Carbon $opd_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Appointment newModelQuery()
 * @method static Builder|Appointment newQuery()
 * @method static Builder|Appointment query()
 * @method static Builder|Appointment whereCreatedAt($value)
 * @method static Builder|Appointment whereDepartmentId($value)
 * @method static Builder|Appointment whereDoctorId($value)
 * @method static Builder|Appointment whereId($value)
 * @method static Builder|Appointment whereOpdDate($value)
 * @method static Builder|Appointment wherePatientId($value)
 * @method static Builder|Appointment whereUpdatedAt($value)
 * @mixin Model
 *
 * @property-read \App\Models\Department $department
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\User $patient
 * @property string|null $problem
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Appointment whereProblem($value)
 *
 * @property int $is_completed
 *
 * @method static Builder|Appointment whereIsCompleted($value)
 */
class Appointment extends Model
{
    /**
     * @var string
     */
    public $table = 'appointments';

    const STATUS_ARR = [
        '2' => 'All',
        '0' => 'Pending',
        '1' => 'Completed',
        '3' => 'Cancelled',
    ];

    const STATUS_PENDING = 0;

    const STATUS_COMPLETED = 1;

    const STATUS_ALL = 2;

    const STATUS_CANCELLED = 3;

    /**
     * @var array
     */
    public $fillable = [
        'patient_id',
        'doctor_id',
        'department_id',
        'opd_date',
        'problem',
        'is_completed',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'doctor_id' => 'integer',
        'department_id' => 'integer',
        'opd_date' => 'datetime',
        'problem' => 'string',
        'is_completed' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required',
        'doctor_id' => 'required',
        'department_id' => 'required',
        'opd_date' => 'required',
        'problem' => 'string|nullable',
    ];

    /**
     * @return array
     */
    public function prepareAppointment(): array
    {
        return [
            'id' => $this->id ?? 'N/A',
            'doctor_name' => $this->doctor->doctorUser->full_name ?? 'N/A',
            'appointment_date' => isset($this->opd_date) ? Carbon::parse($this->opd_date)->format('d M, Y') : 'N/A',
            'appointment_time' => isset($this->opd_date) ? \Carbon\Carbon::parse($this->opd_date)->isoFormat('LT') : 'N/A',
            'doctor_department' => $this->department->title ?? 'N/A',
            'doctor_image_url' => $this->doctor->doctorUser->getApiImageUrlAttribute(),
        ];
    }

    /**
     * @return array
     */
    public function prepareAppointmentForDoctor(): array
    {
        return [
            'id' => $this->id ?? 'N/A',
            'patient_name' => $this->patient->patientUser->full_name ?? 'N/A',
            'appointment_date' => isset($this->opd_date) ? Carbon::parse($this->opd_date)->format('jS M, y') : 'N/A',
            'appointment_time' => isset($this->opd_date) ? \Carbon\Carbon::parse($this->opd_date)->isoFormat('LT') : 'N/A',
            'patient_image' => $this->patient->patientUser->getApiImageUrlAttribute(),
        ];
    }

    /**
     * @return BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * @return BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(DoctorDepartment::class, 'department_id');
    }
}
