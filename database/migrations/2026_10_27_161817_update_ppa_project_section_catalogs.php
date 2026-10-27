<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ppa_projects', function (Blueprint $table): void {
            $table->boolean('is_active')->default(true)->after('sort_order');
            $table->index(['section_code', 'is_active', 'sort_order']);
        });

        $projectsBySection = [
            'lgrpcs' => [
                'Bawat Barangay Makikinabang Program (BBMP)',
                'BFDP',
                'DA-led',
                'FDP',
                'Kalinisan sa Bagong Pilipinas',
                'Labor & Employment Compliance (DOLE-led)',
                'Leagues and Election',
                'LGU Annual Report',
                'Masterlisting of Local Official',
                'NCIP-led Activities',
                'SK FPDP',
                'Social Protection & Vulnerable Sectors (DSWD-led)',
            ],
            'lgpmras' => [
                'CCGLG',
                'CSIS',
                'DOH-led',
                'DSWD-led',
                'Functionality Audits',
                'LGU-PBB',
                'LGUSS',
                'NNC-Led',
            ],
            'lgpopscm' => [
                'Anti-Illegal Drugs',
                'KP',
                'LLA',
                'Peace and Order',
            ],
        ];

        $renamedProjects = [
            'lgrpcs' => [
                'Barangay FDP' => 'BFDP',
                'Full Disclosure Policy (FDP)' => 'FDP',
                'Kalinisan sa Bagong Pilipinas Reports' => 'Kalinisan sa Bagong Pilipinas',
                'LGU Leagues (Election/Meetings)' => 'Leagues and Election',
                'SK Full Public Disclosure Policy (FPDP)' => 'SK FPDP',
            ],
            'lgpmras' => [
                'Citizen Satisfaction Index System (CSIS)' => 'CSIS',
                'DOH and NNC led' => 'DOH-led',
                'LGU Performance-Based Bonus' => 'LGU-PBB',
            ],
            'lgpopscm' => [
                'Anti-Drug Abuse Councils (ADAC) Functionality Audit' => 'Anti-Illegal Drugs',
                'Katarungang Pambarangay (KP)' => 'KP',
                'Local Legislative Awards (LLA)' => 'LLA',
                'Regional Peace and Order Council (RPOC)' => 'Peace and Order',
            ],
        ];

        foreach ($projectsBySection as $sectionCode => $projectNames) {
            DB::table('ppa_projects')
                ->where('section_code', $sectionCode)
                ->update(['is_active' => false]);

            foreach ($renamedProjects[$sectionCode] ?? [] as $oldName => $newName) {
                $oldProject = DB::table('ppa_projects')
                    ->where('section_code', $sectionCode)
                    ->where('name', $oldName)
                    ->first();

                if ($oldProject === null) {
                    continue;
                }

                $newProjectExists = DB::table('ppa_projects')
                    ->where('section_code', $sectionCode)
                    ->where('name', $newName)
                    ->exists();

                if (! $newProjectExists) {
                    DB::table('ppa_projects')
                        ->where('id', $oldProject->id)
                        ->update(['name' => $newName]);
                }
            }

            foreach ($projectNames as $sortOrder => $name) {
                DB::table('ppa_projects')
                    ->where('section_code', $sectionCode)
                    ->where('name', $name)
                    ->where('external_url', 'https://drive.google.com/')
                    ->update(['external_url' => null]);

                $projectQuery = DB::table('ppa_projects')
                    ->where('section_code', $sectionCode)
                    ->where('name', $name);

                if ($projectQuery->exists()) {
                    $projectQuery->update([
                        'is_active' => true,
                        'sort_order' => $sortOrder,
                        'updated_at' => now(),
                    ]);
                } else {
                    DB::table('ppa_projects')->insert([
                        'section_code' => $sectionCode,
                        'name' => $name,
                        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                        'external_url' => null,
                        'sort_order' => $sortOrder,
                        'is_active' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $renamedProjects = [
            'lgrpcs' => [
                'BFDP' => 'Barangay FDP',
                'FDP' => 'Full Disclosure Policy (FDP)',
                'Kalinisan sa Bagong Pilipinas' => 'Kalinisan sa Bagong Pilipinas Reports',
                'Leagues and Election' => 'LGU Leagues (Election/Meetings)',
                'SK FPDP' => 'SK Full Public Disclosure Policy (FPDP)',
            ],
            'lgpmras' => [
                'CSIS' => 'Citizen Satisfaction Index System (CSIS)',
                'DOH-led' => 'DOH and NNC led',
                'LGU-PBB' => 'LGU Performance-Based Bonus',
            ],
            'lgpopscm' => [
                'Anti-Illegal Drugs' => 'Anti-Drug Abuse Councils (ADAC) Functionality Audit',
                'KP' => 'Katarungang Pambarangay (KP)',
                'LLA' => 'Local Legislative Awards (LLA)',
                'Peace and Order' => 'Regional Peace and Order Council (RPOC)',
            ],
        ];

        foreach ($renamedProjects as $sectionCode => $names) {
            foreach ($names as $newName => $oldName) {
                DB::table('ppa_projects')
                    ->where('section_code', $sectionCode)
                    ->where('name', $newName)
                    ->update(['name' => $oldName]);
            }
        }

        Schema::table('ppa_projects', function (Blueprint $table): void {
            $table->dropIndex(['section_code', 'is_active', 'sort_order']);
            $table->dropColumn('is_active');
        });
    }
};
