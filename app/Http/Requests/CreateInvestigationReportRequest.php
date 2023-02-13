<?php

namespace App\Http\Requests;

use App\Models\InvestigationReport;
use Illuminate\Foundation\Http\FormRequest;

class CreateInvestigationReportRequest extends FormRequest
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
        $rules = InvestigationReport::$rules;
        $rules['attachment'] = 'mimes:jpeg,jpg,png,pdf,doc,docx';

        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return InvestigationReport::$messages;
    }
}
