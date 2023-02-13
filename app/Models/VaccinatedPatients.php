<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\VaccinatedPatients
 *
 * @property int $id
 * @property int $patient_id
 * @property int $vaccination_id
 * @property string|null $vaccination_serial_number
 * @property string $dose_number
 * @property \Illuminate\Support\Carbon $dose_given_date
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Vaccination $vaccination
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients query()
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereDoseGivenDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereDoseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereVaccinationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VaccinatedPatients whereVaccinationSerialNumber($value)
 * @mixin Model
 */
class VaccinatedPatients extends Model
{
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'patient_id' => 'required',
        'vaccination_id' => 'required',
        'vaccination_serial_no' => 'string|nullable',
        'dose_number' => 'required|numeric|digits_between:1,50',
        'dose_given_date' => 'required',
    ];

    public $table = 'vaccinated_patients';

    public $fillable = [
        'patient_id',
        'vaccination_id',
        'vaccination_serial_number',
        'dose_number',
        'dose_given_date',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'patient_id' => 'integer',
        'vaccination_id' => 'integer',
        'vaccination_serial_number' => 'string',
        'dose_number' => 'string',
        'dose_given_date' => 'datetime',
        'description' => 'string',
    ];

    /**
     * @return array
     */
    public function prepareVaccinationData(): array
    {
        return [
            'id' => $this->id ?? 'N/A',
            'vaccine_name' => $this->vaccination->name ?? 'N/A',
            'dose_number' => $this->doseNumber(),
            'date' => isset($this->dose_given_date) ? Carbon::parse($this->dose_given_date)->format('d M, Y') : 'N/A',
            'time' => isset($this->dose_given_date) ? \Carbon\Carbon::parse($this->dose_given_date)->isoFormat('LT') : 'N/A',
            'serial_number' => $this->vaccination_serial_number ?? 'N/A',
        ];
    }

    /**
     * @return string
     */
    public function doseNumber(): string
    {
        if ($this->dose_number == 1 || substr($this->dose_number, -1) == 1) {
            return $this->dose_number.''.'st Dose';
        } elseif ($this->dose_number == 2 || substr($this->dose_number, -1) == 2) {
            return $this->dose_number.''.'nd Dose';
        } elseif ($this->dose_number == 3 || substr($this->dose_number, -1) == 3) {
            return $this->dose_number.''.'rd Dose';
        } else {
            return $this->dose_number.''.'th Dose';
        }
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
    public function vaccination()
    {
        return $this->belongsTo(Vaccination::class, 'vaccination_id');
    }
}
