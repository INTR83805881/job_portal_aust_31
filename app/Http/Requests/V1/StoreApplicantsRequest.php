<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApplicantsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'userId' => ['required', 'exists:users,id'], // must correspond to an existing user
            // 'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'qualification' => ['required', 'string', 'max:255'],
            //'skills' => ['required', 'array'], // JSON array
            'resume' => ['nullable', 'string', 'max:255'], // path string
            'coverLetter' => ['nullable', 'string', 'max:255'], // path string
            // 'resume' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],       // must be a PDF, max 2MB
            //'coverLetter' => ['nullable', 'file', 'mimes:pdf', 'max:2048'], // must be a PDF, max 2MB
        ];
    }

     protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->userId,
            'cover_letter' => $this->coverLetter,
            'name' => $this->input('name'),
        ]);
    }
}
