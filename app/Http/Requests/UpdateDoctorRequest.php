<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = Doctor::$rules;
        $rules['email'] = 'required|email:filter|unique:users,email,'.$this->route('doctor')->doctorUser->id;
        $rules['image'] = 'mimes:jpeg,jpg,png,gif';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'image.mimes' => 'The profile image must be a file of type: jpeg, jpg, png.',
        ];
    }
}
