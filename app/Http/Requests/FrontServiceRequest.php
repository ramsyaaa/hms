<?php

namespace App\Http\Requests;

use App\Models\FrontService;
use Illuminate\Foundation\Http\FormRequest;

class FrontServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = FrontService::$rules;
        $rules['icon'] = 'required|mimes:jpg,jpeg,png';

        return $rules;
    }

    public function messages(): array
    {
        return [
            'icon.required' =>  'Please select icon file',
            'icon.mimes' => 'The profile image must be a file of type: jpeg, jpg, png.',
        ];
    }
}
