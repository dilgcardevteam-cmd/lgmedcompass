<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->nullable()->constrained('divisions')->nullOnDelete();

            $table->string('name');

            $table->enum('type', ['file', 'link', 'folder']);

            $table->string('file_path')->nullable();
            $table->text('url')->nullable();

            // Folder system (self-referencing)
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('section_files')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_files');
    }
};
