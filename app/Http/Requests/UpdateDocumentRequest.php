<?php

namespace App\Http\Requests;

use App\Models\Document;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentRequest extends FormRequest
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
        unset($rules['file']);
        $rules['file'] = 'mimes:jpeg,jpg,png,gif,pdf,docx,mp3,mp4,webp';

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'file.mimes' => 'The file must be a file of type: jpeg, jpg, png, git, pdf, docx, mp3, mp4, webp.',
        ];
    }
}
