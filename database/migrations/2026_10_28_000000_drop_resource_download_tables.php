<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('section_files');
        Schema::dropIfExists('resource_files');
        Schema::dropIfExists('resource_folders');
        Schema::dropIfExists('resource_categories');
    }

    public function down(): void
    {
        Schema::create('resource_categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('resource_folders', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')->constrained('resource_categories')->cascadeOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('resource_folders')->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('resource_files', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('folder_id')->constrained('resource_folders')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->enum('type', ['FILE', 'LINK']);
            $table->string('path')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
        });

        Schema::create('section_files', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('division_id')->nullable()->constrained('divisions')->nullOnDelete();
            $table->string('name');
            $table->enum('type', ['file', 'link', 'folder']);
            $table->string('file_path')->nullable();
            $table->text('url')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('section_files')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }
};
