<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class PrescriptionMedicineModal
 *
 * @version July 30, 2022, 6:29 pm UTC
 *
 * @property string $medicine
 * @property string $dosage
 * @property string $day
 * @property string $time
 * @property string $comment
 */
class PrescriptionMedicineModal extends Model
{
    use HasFactory;

    public $table = 'prescriptions_medicines';

    public $fillable = [
        'prescription_id',
        'medicine',
        'dosage',
        'day',
        'time',
        'comment',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'prescription_id' => 'string',
        'medicine' => 'string',
        'dosage' => 'string',
        'day' => 'string',
        'time' => 'string',
        'comment' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    /**
     * @return BelongsTo
     */
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    /**
     * @return HasMany
     */
    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class, 'id', 'medicine');
    }
}
