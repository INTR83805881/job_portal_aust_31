<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantsRequest extends FormRequest
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
          return 
          [
            'userId' => ['required', 'exists:users,id'], // must correspond to an existing user
             'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            //'skills' => ['required', 'array'], // JSON array
            'resume' => ['nullable', 'string', 'max:255'], // path string
            'coverLetter' => ['nullable', 'string', 'max:255'], // path string
            // 'resume' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],       // must be a PDF, max 2MB
            //'coverLetter' => ['nullable', 'file', 'mimes:pdf', 'max:2048'], // must be a PDF, max 2MB
          ];
        }
        else if($method === 'PATCH')
          {
          return 
          [
            'userId' => ['sometimes','required', 'exists:users,id'], // must correspond to an existing user
             'name' => ['sometimes','required', 'string', 'max:255'],
            'address' => ['sometimes','required', 'string', 'max:255'],
            'qualification' => ['sometimes','required', 'string', 'max:255'],
            //'skills' => ['sometimes','required', 'array'], // JSON array
            'resume' => ['sometimes','nullable', 'string', 'max:255'], // path string
            'coverLetter' => ['sometimes','nullable', 'string', 'max:255'], // path string
            // 'resume' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],       // must be a PDF, max 2MB
            //'coverLetter' => ['nullable', 'file', 'mimes:pdf', 'max:2048'], // must be a PDF, max 2MB
          ];
        }
        
    }

    protected function prepareForValidation(): void
{
    $mergeData = [];

    // Map camelCase to snake_case for database
    if ($this->filled('userId')) {
        $mergeData['user_id'] = $this->input('userId');
    }
    if ($this->filled('coverLetter')) {
        $mergeData['cover_letter'] = $this->input('coverLetter');
    }

    if ($this->filled('name')) {
    $mergeData['name'] = $this->input('name'); // merge name
}
    // Keep other fields as-is
    foreach (['address', 'qualification', 'resume'] as $field) {
        if ($this->filled($field)) {
            $mergeData[$field] = $this->input($field);
        }
    }

    if (!empty($mergeData)) {
        $this->merge($mergeData);
    }
}
}
