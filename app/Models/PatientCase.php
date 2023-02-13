<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Str;

/**
 * Class PatientCase
 *
 * @version February 19, 2020, 4:48 am UTC
 *
 * @property int $id
 * @property string $case_id
 * @property int $patient_id
 * @property int $phone
 * @property int $doctor_id
 * @property string $date
 * @property int $status
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Doctor $doctor
 * @property-read Patient $patient
 *
 * @method static Builder|PatientCase newModelQuery()
 * @method static Builder|PatientCase newQuery()
 * @method static Builder|PatientCase query()
 * @method static Builder|PatientCase wherePatientCaseId($value)
 * @method static Builder|PatientCase whereCreatedAt($value)
 * @method static Builder|PatientCase whereDate($value)
 * @method static Builder|PatientCase whereDescription($value)
 * @method static Builder|PatientCase whereDoctorId($value)
 * @method static Builder|PatientCase whereId($value)
 * @method static Builder|PatientCase wherePatientId($value)
 * @method static Builder|PatientCase wherePhone($value)
 * @method static Builder|PatientCase whereStatus($value)
 * @method static Builder|PatientCase whereUpdatedAt($value)
 * @mixin Model
 *
 * @property float $fee
 *
 * @method static Builder|PatientCase whereFee($value)
 * @method static Builder|PatientCase whereCaseId($value)
 *
 * @property int $is_default
 * @property-read \App\Models\BedAssign $bedAssign
 *
 * @method static Builder|PatientCase whereIsDefault($value)
 */
class PatientCase extends Model
{
    /**
     * @var string
     */
    public $table = 'patient_cases';

    const STATUS_ALL = 2;

    const ACTIVE = 1;

    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE => 'Active',
        self::INACTIVE => 'Deactive',
    ];

    const FILTER_STATUS_ARR = [
        0 => 'All',
        1 => 'Active',
        2 => 'Deactive',
    ];

    /**
     * @var array
     */
    public $fillable = [
        'case_id',
        'patient_id',
        'phone',
        'doctor_id',
        'date',
        'status',
        'description',
        'fee',
        'currency_symbol',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'case_id' => 'string',
        'patient_id' => 'integer',
        'doctor_id' => 'integer',
        'phone' => 'string',
        'date' => 'date',
        'status' => 'integer',
        'description' => 'string',
        'currency_symbol' => 'string',
        'fee' => 'double',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required',
        'phone' => 'nullable|numeric',
        'doctor_id' => 'required',
        'date' => 'required',
        'description' => 'nullable',
        'fee' => 'required',
    ];

    /**
     * @return string[]
     */
    public function prepareData(): array
    {
        return [
            'patient_case' => $this->case_id.' '.$this->patient->patientUser->full_name,
        ];
    }

    /**
     * @return array
     */
    public function preparePatientCaseDetailData(): array
    {
        return [
            'id' => $this->id,
            'case_id' => $this->case_id,
            'case_date' => isset($this->date) ? \Carbon\Carbon::parse($this->date)->translatedFormat('jS M, Y,g:i A') : 'N/A',
            'patient' => $this->patient->patientUser->full_name ?? 'N/A',
            'phone' => $this->phone ?? 'N/A',
            'fee' => $this->fee ?? 'N/A',
            'created_on' => $this->created_at->diffForHumans() ?? 'N/A',
            'description' => $this->description ?? 'N/A',
            'currency' => getCurrencySymbol(),
        ];
    }

    /**
     * @return string
     */
    public static function generateUniqueCaseId()
    {
        $caseId = Str::random(8);
        while (true) {
            $isExist = self::whereCaseId($caseId)->exists();
            if ($isExist) {
                self::generateUniqueCaseId();
            }
            break;
        }

        return $caseId;
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
    public function bedAssign()
    {
        return $this->belongsTo(BedAssign::class, 'case_id', 'case_id');
    }

    public function preparePatientCase(): array
    {
        return [
            'id' => $this->id,
            'doctor_name' => $this->doctor->doctorUser->full_name ?? 'N/A',
            'doctor_image' => $this->doctor->doctorUser->getApiImageUrlAttribute() ?? 'N/A',
            'case_id' => $this->case_id ?? 'N/A',
            'status' => self::STATUS_ARR[$this->status] ?? 'N/A',
            'case_date' => isset($this->date) ? Carbon::parse($this->date)->format('jS M, Y') : 'N/A',
            'case_time' => isset($this->date) ? Carbon::parse($this->date)->format('h:i A') : 'N/A',
            'fee' => $this->fee ?? 'N/A',
            'created_on' => $this->created_at->diffForHumans() ?? 'N/A',
            'description' => $this->description ?? 'N/A',
            'currency' => getCurrencySymbol() ?? 'N/A',
        ];
    }
}
