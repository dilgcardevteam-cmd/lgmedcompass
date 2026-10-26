<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('document_processes', function (Blueprint $table) {
            $table->string('type_of_paper')->nullable(); // or ->default('Memorandum') if you prefer
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('document_processes', function (Blueprint $table) {
            //
        });
    }
};
