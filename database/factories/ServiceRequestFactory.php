<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceRequest>
 */
class ServiceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $trackingToken = \Illuminate\Support\Str::random(64);

        return [
            'requester_user_id' => null,
            'requester_name' => fake()->name(),
            'office_address' => fake()->address(),
            'contact_number' => fake()->numerify('09#########'),
            'email' => fake()->safeEmail(),
            'service_type' => \App\Models\ServiceRequest::SERVICE_TYPE_OTHERS,
            'analysis_types' => null,
            'other_service_type' => fake()->words(3, true),
            'target_section_id' => null,
            'assigned_to_id' => null,
            'subject' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'requested_at' => now(),
            'date_needed' => fake()->dateTimeBetween('today', '+30 days')->format('Y-m-d'),
            'document_link' => null,
            'attachment_path' => null,
            'attachment_name' => null,
            'status' => \App\Models\ServiceRequest::STATUS_RECEIVED,
            'claimed_at' => null,
            'last_comment' => null,
            'tracking_token' => $trackingToken,
            'tracking_token_hash' => hash('sha256', $trackingToken),
        ];
    }
}
