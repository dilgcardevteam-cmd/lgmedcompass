<?php

namespace Database\Factories;

use App\Models\LgmedReport;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LgmedReport>
 */
class LgmedReportFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_no' => fake()->unique()->numberBetween(1, 5000),
            'ppa' => fake()->sentence(6),
            'frequency' => fake()->randomElement(['Annual', 'Quarterly', 'Semestral', 'Monthly']),
            'timelines' => fake()->sentence(5),
            'focal_person' => fake()->name(),
            'section' => fake()->randomElement(['LG-RPCS', 'LG-PMRAS', 'LG-POPSCM']),
            'mode_of_submission' => 'Through Google Sheet',
            'end_user_level' => 'Region, Province, HUC, CC, Municipality',
            'ppa_category' => fake()->word(),
            'is_active' => true,
        ];
    }
}
