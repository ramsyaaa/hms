<?php

namespace App\Models;

use App\Repositories\PrescriptionRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * Class Prescription
 *
 * @version March 31, 2020, 12:22 pm UTC
 *
 * @property int patient_id
 * @property string food_allergies
 * @property string tendency_bleed
 * @property string heart_disease
 * @property string high_blood_pressure
 * @property string diabetic
 * @property string surgery
 * @property string accident
 * @property string others
 * @property string medical_history
 * @property string current_medication
 * @property string female_pregnancy
 * @property string breast_feeding
 * @property string health_insurance
 * @property string low_income
 * @property string reference
 * @property bool status
 * @property int $id
 * @property int|null $doctor_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Patient $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereAccident($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereBreastFeeding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereCurrentMedication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereDiabetic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereFemalePregnancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereFoodAllergies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereHealthInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereHeartDisease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereHighBloodPressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereLowIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereMedicalHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereOthers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereSurgery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereTendencyBleed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Prescription whereUpdatedAt($value)
 * @mixin Model
 *
 * @property int $is_default
 * @property-read \App\Models\Doctor|null $doctor
 * * @property-read Collection|PrescriptionMedicineModal[] $getMedicine
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereIsDefault($value)
 *
 * @property string|null $plus_rate
 * @property string|null $temperature
 * @property string|null $problem_description
 * @property string|null $test
 * @property string|null $advice
 * @property string|null $next_visit_qty
 * @property string|null $next_visit_time
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereAdvice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereNextVisitQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereNextVisitTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription wherePlusRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereProblemDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prescription whereTest($value)
 */
class Prescription extends Model
{
    public $table = 'prescriptions';

    public $fillable = [
        'id',
        'patient_id',
        'doctor_id',
        'food_allergies',
        'tendency_bleed',
        'heart_disease',
        'high_blood_pressure',
        'diabetic',
        'surgery',
        'accident',
        'others',
        'medical_history',
        'current_medication',
        'female_pregnancy',
        'breast_feeding',
        'health_insurance',
        'low_income',
        'reference',
        'status',
        'plus_rate',
        'temperature',
        'problem_description',
        'test',
        'advice',
        'next_visit_qty',
        'next_visit_time',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'food_allergies' => 'string',
        'tendency_bleed' => 'string',
        'heart_disease' => 'string',
        'high_blood_pressure' => 'string',
        'diabetic' => 'string',
        'surgery' => 'string',
        'accident' => 'string',
        'others' => 'string',
        'medical_history' => 'string',
        'current_medication' => 'string',
        'female_pregnancy' => 'string',
        'breast_feeding' => 'string',
        'health_insurance' => 'string',
        'low_income' => 'string',
        'reference' => 'string',
        'status' => 'boolean',
        'plus_rate' => 'string',
        'temperature' => 'string',
        'problem_description' => 'string',
        'test' => 'string',
        'advice' => 'string',
        'next_visit_qty' => 'string',
        'next_visit_time' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required',
    ];

    const STATUS_ALL = 2;

    const ACTIVE = 1;

    const INACTIVE = 0;

    const STATUS_ARR = [
        self::STATUS_ALL => 'All',
        self::ACTIVE => 'Active',
        self::INACTIVE => 'Deactive',
    ];

    const DAYS = 0;

    const MONTH = 1;

    const YEAR = 2;

    const TIME_ARR = [
        self::DAYS => 'Days',
        self::MONTH => 'Month',
        self::YEAR => 'Years',
    ];

    const AFETR_MEAL = 0;

    const BEFORE_MEAL = 1;

    const MEAL_ARR = [
        self::AFETR_MEAL => 'After Meal',
        self::BEFORE_MEAL => 'Before Meal',
    ];

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

    public function getMedicine()
    {
        return $this->hasMany(PrescriptionMedicineModal::class);
    }

    /**
     * @return array
     */
    public function preparePrescription(): array
    {
        return [
            'id'                  => $this->id ?? "N/A",
            'doctor_name'         => $this->doctor->doctorUser->full_name ?? "N/A",
            'doctor_image'        => $this->doctor->doctorUser->getApiImageUrlAttribute() ?? "N/A",
            'created_date'        => Carbon::parse($this->created_at)->format('jS M, Y') ?? "N/A",
            'created_time'        => Carbon::parse($this->created_at)->format('h:i A') ?? "N/A",
        ];
    }

    /**
     * @return array
     */
    public function prepareDoctorPrescription(): array
    {
        return [
            'id' => $this->id,
            'patient_name' => $this->patient->patientUser->full_name ?? 'N/A',
            'patient_image' => $this->patient->patientUser->getApiImageUrlAttribute() ?? 'N/A',
            'created_date' => Carbon::parse($this->created_at)->format('jS M, Y') ?? 'N/A',
        ];
    }

    /**
     * @return array
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function prepareDoctorPrescriptionDetailData(): array
    {
        return [
            'id' => $this->id,
            'doctor_id' => $this->doctor->id ?? 'N/A',
            'doctor_name' => $this->doctor->doctorUser->full_name ?? 'N/A',
            'specialist' => $this->doctor->specialist ?? 'N/A',
            'patient_name' => $this->patient->patientUser->full_name ?? 'N/A',
            'patient_age' => Carbon::parse($this->patient->patientUser->dob)->age ?? 'N/A',
            'created_date' => Carbon::parse($this->created_at)->format('jS M, Y') ?? 'N/A',
            'created_time' => Carbon::parse($this->created_at)->format('h:i A') ?? 'N/A',
            'problem' => $this->problem_description ?? 'N/A',
            'test' => $this->test ?? 'N/A',
            'advice' => $this->advice ?? 'N/A',
            'medicine' => $this->prepareMedicine($this->getMedicine) ?? 'N/A',
            'download_prescription' => $this->convertToPdf($this->id),
        ];
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function preparePatientPrescriptionDetailData(): array
    {
        return [
            'doctor_name'           => $this->doctor->doctorUser->full_name ?? "N/A",
            'specialist'            => $this->doctor->specialist ?? "N/A",
            'problem'               => $this->problem_description ?? "N/A",
            'test'                  => $this->test ?? "N/A",
            'advice'                => $this->advice ?? "N/A",
            'medicine'              => $this->prepareMedicine($this->getMedicine) ?? "N/A",
            'download_prescription' => $this->convertToPdf($this->id),
        ];
    }

    /**
     * @param $id
     * @return string
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function convertToPdf($id): string
    {
        $prescription['prescription'] = Prescription::with(['doctor', 'patient', 'getMedicine'])->find($id);
        $data = App()->make(prescriptionRepository::class)->getSyncListForCreate($id);
        $medicines = [];
        foreach ($prescription['prescription']->getMedicine as $medicine) {
            $data['medicine'] = Medicine::where('id', $medicine->medicine)->get();
            array_push($medicines, $data['medicine']);
        }
        if (Storage::exists('prescriptions/Prescription-'.$prescription['prescription']->id.'.pdf')) {
            Storage::delete('prescriptions/Prescription-'.$prescription['prescription']->id.'.pdf');
        }
        $pdf = PDF::loadView('prescriptions.prescription_pdf', compact('prescription', 'medicines', 'data'));
        Storage::disk(config('app.media_disc'))->put('prescriptions/Prescription-'.$prescription['prescription']->id.'.pdf',
            $pdf->output());
        $url = Storage::disk(config('app.media_disc'))->url('prescriptions/Prescription-'.$prescription['prescription']->id.'.pdf');

        return $url ?? 'N/A';
    }

    /**
     * @param $getMedicine
     * @return array
     */
    public function prepareMedicine($getMedicine): array
    {
        $data = [];
        if (! empty($getMedicine)) {
            foreach ($getMedicine as $medicine) {
                $medicineData = Medicine::find($medicine->medicine);
                $data[] = [
                    'name' => $medicineData->name ?? 'N/A',
                    'dosage' => $medicine->dosage ?? 'N/A',
                    'days' => $medicine->day . ' '. 'day' ?? 'N/A',
                    'time' => $medicine->time == 0 ? 'after meal' : 'before meal'  ?? 'N/A',
                ];
            }

            return $data;
        }
    }
}
