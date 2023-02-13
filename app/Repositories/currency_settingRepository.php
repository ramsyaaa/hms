<?php

namespace App\Repositories;

use App\Models\CurrencySetting;

/**
 * Class currency_settingRepository
 *
 * @version September 30, 2022, 8:52 pm UTC
 */
class currency_settingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'currency_name',
        'currency_icon',
        'currency_code',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CurrencySetting::class;
    }

    /**
     * @param  array  $input
     * @return bool
     */
    public function create($input): bool
    {
        $data = [
            'currency_name' => $input['currency_name'],
            'currency_code' => strtoupper($input['currency_code']),
            'currency_icon' => $input['currency_icon'],
        ];

        CurrencySetting::create($data);

        return true;
    }
}
