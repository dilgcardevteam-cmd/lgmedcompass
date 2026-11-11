<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->json('analysis_types')->nullable();
            $table->string('other_service_type')->nullable();
            $table->foreignId('target_section_id')->nullable()->constrained('sections')->nullOnDelete();
            $table->index(['target_section_id', 'status', 'requested_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropIndex('service_requests_target_section_id_status_requested_at_index');
            $table->dropConstrainedForeignId('target_section_id');
            $table->dropColumn(['analysis_types', 'other_service_type']);
        });
    }
};
