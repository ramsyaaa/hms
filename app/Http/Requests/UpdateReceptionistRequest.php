<?php

namespace App\Http\Requests;

use App\Models\Receptionist;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReceptionistRequest extends FormRequest
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
        $rules = Receptionist::$rules;
        $rules['email'] = 'required|email:filter|unique:users,email,'.$this->route('receptionist')->user->id;
        $rules['image'] = 'image|mimes:jpeg,jpg,png,gif';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'image.image' => 'The profile image must be a image.',
            'image.mimes' => 'The profile image must be a file of type: jpeg, jpg, png.',
        ];
    }
}
