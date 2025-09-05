<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateJobsRequest extends FormRequest
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

        if($method == 'PUT')
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
        else if($method == 'PATCH')
        {
            return [
            'organizationId' => ['sometimes','required', 'exists:organizations,id'],
            'title' => ['sometimes','required', 'string', 'max:255'],
            'description' => ['sometimes','required', 'string'],
            'location' => ['sometimes','required', 'string', 'max:255'],
            'salary' => ['sometimes','nullable', 'string', 'max:255'],
            'employmentType' => ['sometimes','required', Rule::in(['full-time', 'part-time', 'internship'])],
            'deadline' => ['sometimes','required', 'date', 'after:today'],
            'status' => ['sometimes','nullable', Rule::in(['enlisted', 'in_progress', 'completed'])],
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
    if ($this->filled('employmentType')) {
        $mergeData['employment_type'] = $this->input('employmentType');
    }

    // Keep other fields as-is
    foreach (['title', 'description', 'location','salary','deadline','status'] as $field) {
        if ($this->filled($field)) {
            $mergeData[$field] = $this->input($field);
        }
    }

    if (!empty($mergeData)) {
        $this->merge($mergeData);
    }
}
}
