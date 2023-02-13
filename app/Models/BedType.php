<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Bed_Type
 *
 * @version February 17, 2020, 8:08 am UTC
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|BedType newModelQuery()
 * @method static Builder|BedType newQuery()
 * @method static Builder|BedType query()
 * @method static Builder|BedType whereCreatedAt($value)
 * @method static Builder|BedType whereDescription($value)
 * @method static Builder|BedType whereId($value)
 * @method static Builder|BedType whereTitle($value)
 * @method static Builder|BedType whereUpdatedAt($value)
 * @mixin Model
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bed[] $beds
 * @property-read int|null $beds_count
 * @property int $is_default
 *
 * @method static Builder|BedType whereIsDefault($value)
 */
class BedType extends Model
{
    /**
     * @var string
     */
    public $table = 'bed_types';

    /**
     * @var array
     */
    public $fillable = [
        'title',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|unique:bed_types,title',
    ];

//    function patientNameRetrieved()
//    {
//        foreach ($this->beds as $bed) {
//            if (count($bed->bedAssigns) > 0) {
//                foreach ($bed->bedAssigns as $bedAssign) {
//                    return $bedAssign->patient->patientUser->full_name;
//                }
//            }
//        }
//    }

    /**
     * @return array
     */
    public function patientNameRetrieved($beds): array
    {
        $data = [];
        foreach ($beds as $bed) {
            $data[] = [
                'id' => $bed->id,
                'name' => ! $bed->is_available ? ! $bed->bedAssigns->isEmpty() && $bed->bedAssigns[0]->discharge_date == null ? $bed->bedAssigns[0]->patient->patientUser->full_name : $this->preparePatientAdmissionData($bed->patientAdmission, $bed->id) : $bed->name,
                'status' => (bool) $bed->is_available,
            ];
        }

        return $data;
    }

    /**
     * @param $patientAdmissions
     * @param $id
     * @return mixed
     */
    public function preparePatientAdmissionData($patientAdmissions, $id)
    {
        foreach ($patientAdmissions as $patientAdmission) {
            if ($patientAdmission->bed->id == $id && ! $patientAdmission->bed->is_available && ($patientAdmission->discharge_date == null)) {
                return $patientAdmission->patient->patientUser->full_name;
            }
        }
    }

    /**
     * @return string[]
     */
    public function prepareData(): array
    {
        return [
            'bed_title' => $this->title,
            'bed' => $this->patientNameRetrieved($this->beds) ?? [],
        ];
    }

    public function bedNameRetrieved($beds): array
    {
        $data = [];
        foreach ($beds as $bed) {
            $data[] = [
                'id' => $bed->id,
                'name' => $bed->name,
                'status' => (bool) $bed->is_available,
            ];
        }

        return $data;
    }

    public function prepareBedData(): array
    {
        return [
            'bed_title' => $this->title,
            'bed' => $this->bedNameRetrieved($this->beds) ?? [],
        ];
    }

    /**
     * @return HasMany
     */
    public function beds()
    {
        return $this->hasMany(Bed::class, 'bed_type');
    }
}
