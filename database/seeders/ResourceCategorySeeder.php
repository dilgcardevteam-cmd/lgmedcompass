<?php

namespace Database\Seeders;

use App\Models\ResourceCategory;
use Illuminate\Database\Seeder;

class ResourceCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Division Chief', 'slug' => 'chief'],
            ['name' => 'Assistant Division Chief', 'slug' => 'assistant-chief'],
            ['name' => 'LG Relations & Policy Compliance Section', 'slug' => 'lgrpcs'],
            ['name' => 'LG Performance Management, Recognition, and Awards Section', 'slug' => 'lgpmras'],
            ['name' => 'LG Peace, Order & Public Safety Compliance Monitoring', 'slug' => 'lgpopscm'],
            ['name' => 'Support Services Unit', 'slug' => 'ssu'],
            ['name' => 'Database & Statistical Unit', 'slug' => 'dsu'],
            ['name' => 'QMS', 'slug' => 'qms'],
        ];

        foreach ($categories as $cat) {
            ResourceCategory::updateOrCreate(
                ['slug' => $cat['slug']], // Check if this slug exists
                ['name' => $cat['name']]  // If yes, update the name. If no, create both.
            );
        }
    }
}
