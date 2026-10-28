<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:event,leave,offsite,official_business,holiday'],
            'visibility_type' => ['required', 'in:private,section,global'],
            'notes' => ['nullable', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'section_id' => [
                'nullable',
                'exists:sections,id',
                'required_if:visibility_type,section',
                'exclude_if:type,offsite',
                'exclude_if:type,official_business',
                'exclude_if:type,leave',
            ],
            'focal_person_id' => [
                'exclude_if:type,official_business',
                'nullable',
                'exists:users,id',
                'required_if:type,leave',
                'required_if:type,offsite',
            ],
            'focal_person_ids' => [
                'exclude_unless:type,official_business',
                'required_if:type,official_business',
                'array',
                'min:1',
            ],
            'focal_person_ids.*' => [
                'exclude_unless:type,official_business',
                'required',
                'integer',
                'distinct',
                'exists:users,id',
            ],

        ];

        // Conditional rule for location
        if (in_array($this->type, ['offsite', 'official_business'], true)) {
            $rules['location'] = [
                'nullable',
                'string',
                'max:255',
                'required_if:type,offsite',
                'required_if:type,official_business',
            ];
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'type.required' => 'Please choose an event type before saving.',
            'start_date.required' => 'Please provide a valid start date.',
            'end_date.required' => 'Please provide a valid end date.',
            'section_id.required' => 'Please select a section.',
            'location.required' => 'Please provide a location for this calendar entry.',
            'focal_person_id.exists' => 'Selected focal person does not exist.',
            'focal_person_ids.required' => 'Select at least one focal person.',
            'focal_person_ids.min' => 'Select at least one focal person.',
            'focal_person_ids.*.exists' => 'A selected focal person does not exist.',
        ];
    }
}
