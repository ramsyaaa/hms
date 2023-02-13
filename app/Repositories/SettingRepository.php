<?php

namespace App\Repositories;

use App\Models\Setting;
use Arr;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Spatie\MediaLibrary\Exceptions\MediaCannotBeDeleted;

/**
 * Class SettingRepository
 *
 * @version February 19, 2020, 1:45 pm UTC
 */
class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'app_name',
        'app_logo',
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
        return Setting::class;
    }

    public function getSyncList()
    {
        return Setting::pluck('value', 'key')->toArray();
    }

    /**
     * @param  array  $input
     *
     * @throws DiskDoesNotExist
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws MediaCannotBeDeleted
     */
    public function updateSetting($input)
    {
        if (isset($input['app_logo']) && ! empty($input['app_logo'])) {
            /** @var Setting $setting */
            $setting = Setting::where('key', '=', 'app_logo')->first();
            $setting->clearMediaCollection(Setting::PATH);
            $setting->addMedia($input['app_logo'])->toMediaCollection(Setting::PATH, config('app.media_disc'));
            $setting = $setting->refresh();
            $setting->update(['value' => $setting->logo_url]);
        }
        if (isset($input['favicon']) && ! empty($input['favicon'])) {
            /** @var Setting $setting */
            $setting = Setting::where('key', '=', 'favicon')->first();
            $setting->clearMediaCollection(Setting::PATH);
            $setting->addMedia($input['favicon'])->toMediaCollection(Setting::PATH, config('app.media_disc'));
            $setting = $setting->refresh();
            $setting->update(['value' => $setting->logo_url]);
        }

        $input['hospital_phone'] = preparePhoneNumber($input, 'hospital_phone');
        $country_code = Setting::where('key', '=', 'country_code')->first();
        if ($country_code->value == $input['country_code']) {
            $input['country_code'] = $country_code->value;
        } else {
            $input['country_code'] = '+'.$input['country_code'];
        }

        $settingInputArray = Arr::only($input, [
            'app_name', 'company_name', 'hospital_email', 'hospital_phone', 'hospital_from_day', 'hospital_from_time',
            'hospital_address', 'current_currency', 'facebook_url', 'twitter_url', 'instagram_url', 'linkedIn_url', 'about_us', 'country_code', 'country_name'
        ]);
        foreach ($settingInputArray as $key => $value) {
            Setting::where('key', '=', $key)->first()->update(['value' => $value]);
        }
    }
}
