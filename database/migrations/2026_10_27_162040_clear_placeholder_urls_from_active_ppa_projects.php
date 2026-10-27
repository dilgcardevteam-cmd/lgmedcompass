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
        DB::table('ppa_projects')
            ->whereIn('section_code', ['lgrpcs', 'lgpmras', 'lgpopscm'])
            ->where('is_active', true)
            ->where('external_url', 'https://drive.google.com/')
            ->update([
                'external_url' => null,
                'updated_at' => now(),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
