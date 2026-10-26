<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('document_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // creator
            $table->string('subject_title');
            $table->string('focal_person');
            $table->text('document_link')->nullable();
            $table->text('remarks')->nullable();
            $table->json('file_path')->nullable(); // store array of file paths
            $table->foreignId('assigned_to_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('Draft');
            $table->text('last_comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_processes');
    }
};
