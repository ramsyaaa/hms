<?php

namespace App\Http\Requests;

use App\Models\Postal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
//use Route;

/**
 * Class PostalRequest
 */
class PostalRequest extends FormRequest
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
        $rules = Postal::$rules;
        $rules['attachment'] = 'mimes:jpeg,jpg,png,gif';

        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages(): array
    {
        if (Route::current()->getName() == 'dispatches.store') {
            return [
                'required_if' => 'The :attribute field is required.',
            ];
        }

        return [
            'required_if' => 'The :attribute field is required.',
            'attachment.mimes' => 'The attachment must be a file of type: jpeg, jpg, png.',
        ];
    }
}
