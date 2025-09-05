<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateOrganizationsRequest extends FormRequest
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
            'userId' => ['required', 'exists:users,id'],
            //'name' => ['required', 'string', 'max:255'],
            'companyName' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ];
        }
        else if($method === 'PATCH')
        {
            return [
            'userId' => ['sometimes','required', 'exists:users,id'],
            //'name' => ['sometimes','required', 'string', 'max:255'],
            'companyName' => ['sometimes','required', 'string', 'max:255'],
            'address' => ['sometimes','required', 'string', 'max:255'],
        ];
        }
        
    }

protected function prepareForValidation(): void
{
    $mergeData = [];

    // Map camelCase to snake_case for database
  
    if ($this->has('userId')) {
        $mergeData['user_id'] = $this->input('userId');
    }
   if ($this->has('companyName')) {
    $mergeData['company_name'] = $this->input('companyName');
}

 foreach (['address'] as $field) {
        if ($this->filled($field)) {
            $mergeData[$field] = $this->input($field);
        }
    }

    if (!empty($mergeData)) {
        $this->merge($mergeData);
    }
}
}
