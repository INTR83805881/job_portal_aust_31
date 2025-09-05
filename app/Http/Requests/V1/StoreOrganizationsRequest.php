<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'company_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $mergeData = [];

        if ($this->filled('userId')) {
            $mergeData['user_id'] = $this->input('userId');
        }

        if ($this->filled('companyName')) {
            $mergeData['company_name'] = $this->input('companyName');
        }

        if ($this->filled('address')) {
            $mergeData['address'] = $this->input('address');
        }

        if (!empty($mergeData)) {
            $this->merge($mergeData);
        }
    }
}
