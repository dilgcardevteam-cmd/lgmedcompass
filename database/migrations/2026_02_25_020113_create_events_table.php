<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Owner
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // Section (only required for section events)
            $table->foreignId('section_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            // Optional focal person
            $table->foreignId('focal_person_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->string('title');
            $table->string('link')->nullable();
            $table->string('type')->nullable();
            $table->string('location')->nullable();
            $table->text('notes')->nullable();

            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->enum('visibility_type', [
                'private',   // only creator
                'section',   // specific section
                'global',     // everyone
            ])->default('private');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
