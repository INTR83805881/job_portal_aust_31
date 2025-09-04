<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrganizationsRequest extends FormRequest
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
            'userId' => ['required', 'exists:users,id'],
            'companyName' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            //'contacts' => ['nullable', 'array'], // JSON array of contacts
        ];
    }
     protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->userId,
            'company_name' => $this->companyName,
        ]);
    }
}
