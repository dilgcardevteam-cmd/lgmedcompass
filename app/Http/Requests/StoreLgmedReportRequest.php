<?php

namespace App\Http\Requests;

use App\Models\LgmedReport;
use Illuminate\Foundation\Http\FormRequest;

class StoreLgmedReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', LgmedReport::class) ?? false;
    }

    /**
     * Join multi-person checkbox arrays into one name per line and resolve the "Others" frequency.
     */
    protected function prepareForValidation(): void
    {
        $merge = [];

        foreach (LgmedReport::MULTI_VALUE_FIELDS as $field) {
            $value = $this->input($field);
            if (is_array($value)) {
                $names = array_filter(array_map('trim', array_filter($value, 'is_string')));
                $merge[$field] = $names === [] ? null : implode("\n", $names);
            }
        }

        if ($this->input('frequency') === LgmedReport::OTHER_FREQUENCY && filled($this->input('frequency_other'))) {
            $merge['frequency'] = trim((string) $this->input('frequency_other'));
        }

        $this->merge($merge);
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'frequency_other' => ['nullable', 'string', 'max:255', 'required_if:frequency,'.LgmedReport::OTHER_FREQUENCY],
            'item_no' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'ppa' => ['required', 'string', 'max:5000'],
            'frequency' => ['nullable', 'string', 'max:255'],
            'timelines' => ['nullable', 'string', 'max:5000'],
            'focal_person' => ['nullable', 'string', 'max:5000'],
            'section' => ['nullable', 'string', 'max:255'],
            'mode_of_submission' => ['nullable', 'string', 'max:5000'],
            'monitoring_link' => ['nullable', 'string', 'max:5000'],
            'end_user_level' => ['nullable', 'string', 'max:255'],
            'ppa_category' => ['nullable', 'string', 'max:255'],
            'legal_basis_reference' => ['nullable', 'string', 'max:5000'],
            'reference_link' => ['nullable', 'string', 'max:5000'],
            'remarks' => ['nullable', 'string', 'max:5000'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'ppa.required' => 'The PPA field is required.',
            'ppa.max' => 'The PPA may not exceed 5000 characters.',
            'item_no.integer' => 'The No. must be a whole number.',
            'frequency_other.required_if' => 'Please specify the frequency.',
        ];
    }
}
