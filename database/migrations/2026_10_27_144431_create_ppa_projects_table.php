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
        Schema::create('ppa_projects', function (Blueprint $table) {
            $table->id();
            $table->string('section_code', 20);
            $table->string('name');
            $table->text('description');
            $table->text('external_url')->nullable();
            $table->unsignedSmallInteger('sort_order');
            $table->timestamps();

            $table->index(['section_code', 'sort_order']);
        });

        $projectsBySection = [
            'lgrpcs' => [
                'Barangay Assembly',
                'Barangay at Kalinisan Day (BarKaDa)',
                'Barangay FDP',
                'Barangay Road Clearing Operations (BaRCO)',
                'CPD-led Programs (Family/RPRH, Population)',
                'DA-led',
                'Election-Related Concerns (non-legal matters)',
                'Full Disclosure Policy (FDP)',
                "Halina't magtanim ng Prutas at Gulay (HAPAG)",
                'IPMR (Indigenous Peoples Mandatory Representation)',
                'Kalinisan sa Bagong Pilipinas Reports',
                'Labor & Employment Compliance (DOLE-led)',
                'LG Month Celebration',
                'LGU Annual Report',
                'LGU Celebrations',
                'LGU Leagues (Election/Meetings)',
                'NCIP-led Activities',
                'SK Full Public Disclosure Policy (FPDP)',
                'SK, NYC and Youth Related PPAs',
                'Social Protection & Vulnerable Sectors (DSWD-led)',
            ],
            'lgpmras' => [
                'Child-Related',
                'Child-Friendly Local Government Audit (CFLGA)',
                'Citizen Satisfaction Index System (CSIS)',
                'DOH and NNC led',
                "Juvenille Justice and Welfare Related PPA's",
                'LGU Performance-Based Bonus',
                'Local Committee on (LCAT-VAWC) Functionality Audit Anti-Trafficking',
                'Persons With Disability / PDAO',
                'Seal of Good Local Governance (SGLG)',
                'SGLGB',
            ],
            'lgpopscm' => [
                'Anti-Drug Abuse Councils (ADAC) Functionality Audit',
                'Cockpit and Cockfighting Monitoring',
                'Comprehensive Social Benefits Program (CSBP)',
                'Enhanced Comprehensive Local Integration Program (ECLIP)',
                'Human Rights Action Center (HRAC)',
                'Katarungang Pambarangay (KP)',
                'Local Legislative Awards (LLA)',
                'NTF/RTF ELCAC related activities',
                'Philippine Anti-Drugs Strategy (PADS)-related PPAS',
                'POGO Report',
                'Preventing and Countering Violent Extremism and Insurgency (PCVE)',
                'Regional Adjudication Committee (RAC)',
                'Regional Peace and Order Council (RPOC)',
            ],
            'ssu' => [
                'Inventory/Supplies/Properties',
                'Monitor the submission of Administrative Requirements and other admin matters',
                'Records Management',
                'Take Minutes of Division and SPMS-related meetings',
            ],
            'dsu' => [
                'Data analysis on functional/audit results, and others',
                'Masterlisting (BIS and ELOPDS)',
                'Monitoring Report on the Accreditation and Representation of Barangay- Based CSOs/NGOS',
                'Other Barangay Certification',
            ],
        ];

        $timestamp = now();
        $projects = [];

        foreach ($projectsBySection as $sectionCode => $names) {
            foreach ($names as $sortOrder => $name) {
                $projects[] = [
                    'section_code' => $sectionCode,
                    'name' => $name,
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    'external_url' => 'https://drive.google.com/',
                    'sort_order' => $sortOrder,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }
        }

        DB::table('ppa_projects')->insert($projects);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ppa_projects');
    }
};
