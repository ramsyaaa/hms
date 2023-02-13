<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class Patient
 *
 * @version February 14, 2020, 5:53 am UTC
 *
 * @property int user_id
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $patientUser
 *
 * @method static Builder|Patient newModelQuery()
 * @method static Builder|Patient newQuery()
 * @method static Builder|Patient query()
 * @method static Builder|Patient whereCreatedAt($value)
 * @method static Builder|Patient whereId($value)
 * @method static Builder|Patient whereUpdatedAt($value)
 * @method static Builder|Patient whereUserId($value)
 * @mixin Model
 *
 * @property int $is_default
 * @property-read \App\Models\Address|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PatientAdmission[] $admissions
 * @property-read int|null $admissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AdvancedPayment[] $advancedpayments
 * @property-read int|null $advancedpayments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bill[] $bills
 * @property-read int|null $bills_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PatientCase[] $cases
 * @property-read int|null $cases_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Document[] $documents
 * @property-read int|null $documents_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VaccinatedPatients[] $vaccinations
 * @property-read int|null $vaccinations_count
 *
 * @method static Builder|Patient whereIsDefault($value)
 */
class Patient extends Model
{
    public $table = 'patients';

    public $fillable = [
        'user_id',
    ];

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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
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
        'gender' => 'required',
        'dob' => 'nullable|date',
        'phone' => 'nullable|numeric',
        'address1' => 'nullable|string',
        'address2' => 'nullable|string',
        'city' => 'nullable|string',
        'zip' => 'nullable|integer',
    ];

    public static function getActivePatientNames()
    {
        $patients = DB::table('users')
            ->where('status', '=', 1)
            ->join('patients', 'users.id', '=', 'patients.user_id')
            ->select(['users.first_name', 'users.last_name', 'patients.id'])
            ->orderBy('first_name')
            ->get();
        $patientsNames = collect();
        foreach ($patients as $patient) {
            $patientsNames[$patient->id] = ucfirst($patient->first_name).' '.ucfirst($patient->last_name);
        }

        return $patientsNames;
    }

    /**
     * @return array
     */
    public function prepareData(): array
    {
        return [
            'id' => $this->id,
            'patient_name' => $this->patientUser->full_name,
        ];
    }

    /**
     * @return BelongsTo
     */
    public function patientUser()
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
     * @return HasMany
     */
    public function cases()
    {
        return $this->hasMany(PatientCase::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function admissions()
    {
        return $this->hasMany(PatientAdmission::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function bills()
    {
        return $this->hasMany(Bill::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function advancedpayments()
    {
        return $this->hasMany(AdvancedPayment::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'patient_id');
    }

    /**
     * @return HasMany
     */
    public function vaccinations()
    {
        return $this->hasMany(VaccinatedPatients::class, 'patient_id');
    }

    public function opd()
    {
        return $this->hasMany(OpdPatientDepartment::class, 'patient_id');
    }

    public function opdDepartment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(OpdPatientDepartment::class, 'patient_id');
    }
}
