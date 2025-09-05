<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateOrganization_contactsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'organizationId'=>['required', 'exists:organizations,id'],
             'type' => ['required', Rule::in(['phone', 'email','website'])],
             'value' => ['required', 'string', 'max:255'],
        ];
        }
        else if($method=='PATCH')
        {
            return 
            [
            'organizationId'=>['sometimes','required', 'exists:organizations,id'],
             'type' => ['sometimes','required', Rule::in(['phone', 'email','website'])],
             'value' => ['sometimes','required', 'string', 'max:255'],
            ];
        }

    }

 protected function prepareForValidation(): void
{
    $mergeData = [];

    // Map camelCase to snake_case for database
    if ($this->filled('organizationId')) {
        $mergeData['organization_id'] = $this->input('organizationId');
    }
    
    if (!empty($mergeData)) {
        $this->merge($mergeData);
    }
}


}
