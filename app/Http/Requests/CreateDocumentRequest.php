<?php

namespace App\Http\Requests;

use App\Models\Document;
use Illuminate\Foundation\Http\FormRequest;

class CreateDocumentRequest extends FormRequest
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
        $rules = Document::$rules;
        $rules['file'] = 'required|mimes:jpeg,jpg,png,gif,pdf,docx,webp,mp3,mp4';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'file.required' => 'Please select attachment',
        ];
    }
}
