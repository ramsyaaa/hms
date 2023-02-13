<?php

namespace App\Http\Requests;

use App\Models\Income;
use Illuminate\Foundation\Http\FormRequest;

class CreateIncomeRequest extends FormRequest
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
        $rules = Income::$rules;
        $rules['attachment'] = 'mimes:jpeg,jpg,png,gif';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'attachment.mimes' => 'The profile image must be a file of type: jpeg, jpg, png.',
        ];
    }
}
