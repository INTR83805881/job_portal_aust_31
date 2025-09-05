<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreOrganization_contactsRequest extends FormRequest
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
        return [
            'organizationId'=>['required', 'exists:organizations,id'],
             'type' => ['required', Rule::in(['phone', 'email','website'])],
             'value' => ['required', 'string', 'max:255'],
        ];
    }
     protected function prepareForValidation(): void
    {
        $this->merge([
            'organization_id' => $this->organizationId,
        ]);
    }
}
