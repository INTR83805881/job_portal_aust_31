<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateApplicant_contactsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if($method=='PUT')
        {
             return [
             'applicantId'=>['required', 'exists:applicants,id'],
             'type' => ['required', Rule::in(['phone', 'email'])],
             'value' => ['required', 'string', 'max:255'],
        ];
        }
        else if($method=='PATCH')
        {
            return 
            [
             'applicantId'=>['sometimes','required', 'exists:applicants,id'],
             'type' => ['sometimes','required', Rule::in(['phone', 'email'])],
             'value' => ['sometimes','required', 'string', 'max:255'],
            ];
        }
       
    }

          protected function prepareForValidation(): void
{
    $mergeData = [];

    // Map camelCase to snake_case for database
    if ($this->filled('applicantId')) {
        $mergeData['applicant_id'] = $this->input('applicantId');
    }
    
    if (!empty($mergeData)) {
        $this->merge($mergeData);
    }
}
}
