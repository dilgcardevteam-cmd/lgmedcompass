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
        // Add indexes to documents table
        Schema::table('documents', function (Blueprint $table) {
            $table->index('section');
            $table->index('frequency');
            $table->index('focal_person');
            $table->index('status');
            $table->index('created_at');
            $table->index('deleted_at'); // useful for soft deletes
        });

        // Add indexes to document_schedules table (if exists)
        if (Schema::hasTable('document_schedules')) {
            Schema::table('document_schedules', function (Blueprint $table) {
                $table->index('due_date');
                $table->index('status');
            });
        }

        // Optional: Full-text index for search columns (MySQL only)
        // Uncomment if you use MySQL and want faster search on these columns
        // DB::statement('ALTER TABLE documents ADD FULLTEXT INDEX documents_search_idx (subject_title, focal_person)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropIndex(['section']);
            $table->dropIndex(['frequency']);
            $table->dropIndex(['focal_person']);
            $table->dropIndex(['status']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['deleted_at']);
        });

        if (Schema::hasTable('document_schedules')) {
            Schema::table('document_schedules', function (Blueprint $table) {
                $table->dropIndex(['due_date']);
                $table->dropIndex(['status']);
            });
        }

        // DB::statement('ALTER TABLE documents DROP INDEX documents_search_idx');
    }
};
