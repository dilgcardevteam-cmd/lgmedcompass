<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            ['name' => 'Division Chief', 'color' => '#2ECC71'],
            ['name' => 'Assistant Division Chief', 'color' => '#9B5DE5'],
            ['name' => 'LG-Relations and Policy Compliance Section', 'color' => '#FF6B6B'],
            ['name' => 'LG-Performance Management, Recognition, and Awards Section', 'color' => '#4ECDC4'],
            ['name' => 'LG-Peace & Order, Public Safety Compliance and Monitoring', 'color' => '#1A73E8'],
            ['name' => 'Support Services Unit', 'color' => '#F4A261'],
            ['name' => 'Database and Statistical Unit', 'color' => '#c2edc7ff'],
        ];

        foreach ($sections as $section) {
            Section::updateOrCreate(
                ['name' => $section['name']],
                [
                    'color' => $section['color'],
                    'is_protected' => true,
                ]
            );
        }
    }
}
