<?php

namespace App\Http\Requests;

use App\Models\Document;
use App\Models\FrontService;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFrontServiceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = FrontService::$rules;
        unset($rules['icon']);
        $rules['icon'] = 'mimes:jpeg,jpg,png,gif,pdf,docx,mp3,mp4,webp';

        return $rules;
    }
}
