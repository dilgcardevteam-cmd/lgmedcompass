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
        Schema::table('document_processes', function (Blueprint $table) {
            $table->string('type_of_paper_other')->nullable()->after('type_of_paper');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_processes', function (Blueprint $table) {
            $table->dropColumn('type_of_paper_other');
        });
    }
};
