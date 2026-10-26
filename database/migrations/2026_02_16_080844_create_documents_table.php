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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('subject_title');
            $table->string('from');
            $table->string('section');
            $table->string('recipient_name')->nullable();
            $table->string('frequency');
            $table->string('focal_person');
            $table->string('requesting_office')->default('N/A');
            $table->string('reference')->nullable();
            $table->string('mode_of_submission')->nullable();
            $table->string('cy_link')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('progress')->default(0);
            $table->string('status')->default('To Do');
            $table->string('file_path')->nullable();
            $table->string('document_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
