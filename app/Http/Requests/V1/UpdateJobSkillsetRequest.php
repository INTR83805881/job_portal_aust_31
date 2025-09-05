<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateJobSkillsetRequest extends FormRequest
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
           'jobId'=>['required', 'exists:jobs,id'],
           'skillId'=>['required', 'exists:skills,id'],
        ];
       }
       else if($method == 'PATCH')
       {
        return [
           'jobId'=>['sometimes','required', 'exists:jobs,id'],
           'skillId'=>['sometimes','required', 'exists:skills,id'],
        ];
       }
        
    }

protected function prepareForValidation(): void
{
    $mergeData = [];

    // Map camelCase to snake_case for database
    if ($this->filled('jobId')) {
        $mergeData['job_id'] = $this->input('jobId');
    }
    if ($this->filled('skillId')) {
        $mergeData['skill_id'] = $this->input('skillId');
    }

    if (!empty($mergeData)) {
        $this->merge($mergeData);
    }
}
}
