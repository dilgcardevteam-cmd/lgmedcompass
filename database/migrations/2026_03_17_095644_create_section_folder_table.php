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
        Schema::create('section_folder', function (Blueprint $table) {

            $table->id();

            $table->foreignId('divisions_id')
                ->constrained('divisions')
                ->cascadeOnDelete();

            $table->string('name');

            $table->enum('type', ['FILE', 'LINK']);

            $table->string('path')->nullable(); // uploaded file

            $table->text('url')->nullable(); // link

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_folder');
    }
};
