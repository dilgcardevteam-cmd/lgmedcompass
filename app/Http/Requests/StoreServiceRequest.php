<?php

namespace App\Http\Requests;

use App\Models\ServiceRequest as ServiceRequestModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($user = $this->user()) {
            $this->merge([
                'requester_name' => $user->name,
                'email' => $user->email,
            ]);
        }
    }

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
            'requester_name' => ['required', 'string', 'max:255'],
            'office_address' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:255'],
            'service_type' => ['required', Rule::in([
                ServiceRequestModel::SERVICE_TYPE_DATA_ANALYSIS,
                ServiceRequestModel::SERVICE_TYPE_OTHERS,
            ])],
            'analysis_types' => [
                Rule::requiredIf($this->input('service_type') === ServiceRequestModel::SERVICE_TYPE_DATA_ANALYSIS),
                'array',
                'min:1',
                'max:'.count(ServiceRequestModel::ANALYSIS_TYPES),
            ],
            'analysis_types.*' => ['required', 'string', Rule::in(ServiceRequestModel::ANALYSIS_TYPES)],
            'other_service_type' => [
                Rule::requiredIf($this->input('service_type') === ServiceRequestModel::SERVICE_TYPE_OTHERS),
                'nullable',
                'string',
                'max:255',
            ],
            'subject' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'date_needed' => ['required', 'date', 'after_or_equal:today'],
            'document_link' => ['nullable', 'url', 'max:2048'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'date_needed.after_or_equal' => 'The date needed must be today or a future date.',
            'attachment.mimes' => 'Supporting documents must be a PDF, DOC, or DOCX file.',
            'attachment.max' => 'The supporting document may not be larger than 5 MB.',
        ];
    }
}
