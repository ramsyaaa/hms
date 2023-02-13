<?php

namespace App\Models;

use App\Repositories\PatientDiagnosisTestRepository;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\PatientDiagnosisTest
 *
 * @property int $id
 * @property int $patient_id
 * @property int $doctor_id
 * @property int $category_id
 * @property string $report_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DiagnosisCategory $category
 * @property-read \App\Models\Doctor $doctor
 * @property-read \App\Models\Patient $patient
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereDoctorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereReportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PatientDiagnosisTest whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property-read Collection|PatientDiagnosisProperty[] $patientDiagnosisProperties
 * @property-read int|null $patient_diagnosis_properties_count
 */
class PatientDiagnosisTest extends Model
{
    protected $table = 'patient_diagnosis_tests';

    public $fillable = [
        'patient_id',
        'doctor_id',
        'category_id',
        'report_number',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'patient_id'    => 'integer',
        'doctor_id'     => 'integer',
        'category_id'   => 'integer',
        'report_number' => 'string',
        'create_at'     => 'datetime',
        'updated_at'    => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id'          => 'required|unique:patient_diagnosis_tests,patient_id',
        'category_id'         => 'required',
        'age'                 => 'integer|nullable',
        'height'              => 'integer|nullable',
        'weight'              => 'integer|nullable',
        'blood_pressure'      => 'integer|nullable',
        'average_glucose'     => 'string|nullable',
        'fasting_blood_sugar' => 'string|nullable',
        'urine_sugar'         => 'string|nullable',
        'cholesterol'         => 'string|nullable',
        'diabetes'            => 'string|nullable',
    ];

    /**
     * @var string[]
     */
    public static $messages = [
        'patient_id.unique' => 'The patient\'s name has already been taken.',
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

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(DiagnosisCategory::class, 'category_id');
    }

    /**
     * @return HasMany
     */
    public function patientDiagnosisProperties()
    {
        return $this->hasMany(PatientDiagnosisProperty::class, 'patient_diagnosis_id');
    }

    public function prepareDiagnosis(): array
    {
        return [
            'id'            => $this->id,
            'patient_name'  => $this->patient->patientUser->full_name ?? 'N/A',
            'patient_image' => $this->patient->patientUser->getApiImageUrlAttribute() ?? 'N/A',
            'category'      => $this->category->name ?? 'N/A',
            'report_number' => $this->report_number ?? 'N/A',
            'created_at'    => Carbon::parse($this->created_at)->format('jS M, Y') ?? 'N/A',
            'pdf_url'       => $this->convertToPdf($this->id),
        ];
    }

    public function convertToPdf($id)
    {
        $patientDiagnosisTest = PatientDiagnosisTest::find($id);
        $patientDiagnosisTestRepository = App()->make(patientDiagnosisTestRepository::class);
        $data = $patientDiagnosisTestRepository->getSettingList();
        $data['patientDiagnosisTest'] = $patientDiagnosisTest;
        $data['patientDiagnosisTests'] = $patientDiagnosisTestRepository->getPatientDiagnosisTestProperty($patientDiagnosisTest->id);

        if (Storage::exists('diagnosis/Diagnosis-'.$this->report_number.'.pdf')) {
            Storage::delete('diagnosis/Diagnosis-'.$this->report_number.'.pdf');
        }
        $pdf = PDF::loadView('employees.patient_diagnosis_test.diagnosis_test_pdf', $data);
        Storage::disk(config('app.media_disc'))->put('diagnosis/Diagnosis-'.$this->report_number.'.pdf',
            $pdf->output());
        $url = Storage::disk(config('app.media_disc'))->url('diagnosis/Diagnosis-'.$this->report_number.'.pdf');

        return $url ?? 'N/A';
    }

    public function prepareDiagnosisDetailForDoctor(): array
    {
        return [
            'id'                => $this->id ?? 'N/A',
            'patient_name'      => $this->patient->patientUser->full_name ?? 'N/A',
            'patient_image'     => $this->patient->patientUser->getApiImageUrlAttribute() ?? 'N/A',
            'category'          => $this->category->name ?? 'N/A',
            'report_number'     => $this->report_number ?? 'N/A',
            'patient_diagnosis' => $this->propertiesPrepare() ?? 'N/A',
            'created_on'        => Carbon::parse($this->created_at)->diffForHumans() ?? 'N/A',
            'pdf_url'           => $this->convertToPdf($this->id) ?? 'N/A',
        ];
    }

    public function prepareDiagnosisDetailForPatient(): array
    {
        return [
            'id'                => $this->id ?? 'N/A',
            'patient_name'      => $this->doctor->doctorUser->full_name ?? 'N/A',
            'patient_image'     => $this->doctor->doctorUser->getApiImageUrlAttribute() ?? 'N/A',
            'category'          => $this->category->name ?? 'N/A',
            'report_number'     => $this->report_number ?? 'N/A',
            'patient_diagnosis' => $this->propertiesPrepare() ?? 'N/A',
            'created_on'        => Carbon::parse($this->created_at)->diffForHumans() ?? 'N/A',
            'pdf_url'           => $this->convertToPdf($this->id) ?? 'N/A',
        ];
    }

    public function propertiesPrepare(): array
    {
        $data = [];
        foreach ($this->patientDiagnosisProperties as $diagnosisProperty) {
            $data[$diagnosisProperty->property_name] = $diagnosisProperty->property_value ?? 'N/A';
        }

        return $data;
    }
}
