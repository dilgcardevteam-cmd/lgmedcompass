<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePpaProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'Admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'external_url' => ['nullable', 'url', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'A project name is required.',
            'description.required' => 'A project description is required.',
            'description.max' => 'The project description may not exceed 5000 characters.',
            'external_url.url' => 'Enter a valid Google Drive link.',
            'external_url.max' => 'The Google Drive link may not exceed 2048 characters.',
        ];
    }
}
