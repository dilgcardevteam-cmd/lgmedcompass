<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run()
    {
        $divisions = [
            [
                'id' => 1,
                'code' => 'LGPCRDM',
                'name' => 'Local Government Relations & Policy Compliance Section',
            ],
            [
                'id' => 2,
                'code' => 'LGPMRAS',
                'name' => 'Local Government Performance Management, Recognition, and Awards Section',
            ],
            [
                'id' => 3,
                'code' => 'LGPOPS',
                'name' => 'Local Government Peace and Order and Public Safety Compliance and Monitoring',
            ],
            [
                'id' => 4,
                'code' => 'SSU',
                'name' => 'Support Services Unit',
            ],
            [
                'id' => 5,
                'code' => 'DSU',
                'name' => 'Database & Statistical Unit',
            ],
        ];

        foreach ($divisions as $division) {
            Division::updateOrCreate(
                ['id' => $division['id']],
                $division
            );
        }
    }
}
