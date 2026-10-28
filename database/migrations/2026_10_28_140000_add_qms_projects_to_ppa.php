<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $projects = [
            'QP 01 BODBA',
            'QP 02 APMV',
            'QP 03 FTA',
            'QP 04 FDP',
            'QP 05 Confidential Funds',
            'QP 06 CSC Service Rendered',
            'QP 07 Cert of Incumbency',
            'QP 43 LTIA',
            'QP 44 Seal of Good Local Governance (SGLG) Assessment Shared Folder',
        ];
        $timestamp = now();

        DB::table('ppa_projects')->insert(array_map(
            fn (string $name, int $sortOrder): array => [
                'section_code' => 'qms',
                'name' => $name,
                'description' => $name,
                'external_url' => null,
                'sort_order' => $sortOrder,
                'is_active' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            $projects,
            array_keys($projects)
        ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('ppa_projects')
            ->where('section_code', 'qms')
            ->whereIn('name', [
                'QP 01 BODBA',
                'QP 02 APMV',
                'QP 03 FTA',
                'QP 04 FDP',
                'QP 05 Confidential Funds',
                'QP 06 CSC Service Rendered',
                'QP 07 Cert of Incumbency',
                'QP 43 LTIA',
                'QP 44 Seal of Good Local Governance (SGLG) Assessment Shared Folder',
            ])
            ->delete();
    }
};
