<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreJobsRequest extends FormRequest
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
            'organizationId' => ['required', 'exists:organizations,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'salary' => ['nullable', 'string', 'max:255'],
            'employmentType' => ['required', Rule::in(['full-time', 'part-time', 'internship'])],
            'deadline' => ['required', 'date', 'after:today'],
            'status' => ['nullable', Rule::in(['enlisted', 'in_progress', 'completed'])],
        ];
    }

    protected function prepareForValidation(): void
{
    $this->merge([
        'organization_id' => $this->organizationId,
        'employment_type' => $this->employmentType,
    ]);
}
}
