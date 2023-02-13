<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class currency_setting
 *
 * @version September 30, 2022, 8:52 pm UTC
 *
 * @property string $currency_name
 * @property string $currency_icon
 * @property string $currency_code
 */
class CurrencySetting extends Model
{
    use HasFactory;

    public $table = 'currency_settings';

    public $fillable = [
        'id',
        'currency_name',
        'currency_code',
        'currency_icon',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'currency_name' => 'string',
        'currency_code' => 'string',
        'currency_icon' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'currency_name' => 'required|unique:currency_settings',
        'currency_icon' => 'required',
        'currency_code' => 'required|min:3|max:3',
    ];
}
