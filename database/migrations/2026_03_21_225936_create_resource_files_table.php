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
        Schema::create('resource_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folder_id')->constrained('resource_folders')->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', ['FILE', 'LINK']);
            $table->string('path')->nullable(); // stored file path
            $table->text('url')->nullable();    // external link
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_files');
    }
};
