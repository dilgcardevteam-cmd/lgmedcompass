<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return (bool) $this->user()?->can('manage-accounts');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => ['required', 'in:Admin,Employee,Technical Inspector'],
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'Please select a role before updating the account.',
            'role.in' => 'The selected role must be Admin, Employee, or Technical Inspector.',
        ];
    }
}
