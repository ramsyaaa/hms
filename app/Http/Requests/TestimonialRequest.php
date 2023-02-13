<?php

namespace App\Http\Requests;

use App\Models\Testimonial;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateTestimonialRequest
 */
class TestimonialRequest extends FormRequest
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
        $rules = Testimonial::$rules;
        $rules['profile'] = 'mimes:jpeg,jpg,png,gif';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'profile.mimes' => 'The profile image must be a file of type: jpeg, jpg, png.',
        ];
    }
}
