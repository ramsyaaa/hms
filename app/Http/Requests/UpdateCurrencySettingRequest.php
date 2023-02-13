<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencySettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['currency_name'] = 'required|unique:currency_settings,currency_name,'.$this->route('currency_setting')->id;
        $rules['currency_icon'] = 'required';
        $rules['currency_code'] = 'required|min:3|max:3';

        return $rules;
    }
}
