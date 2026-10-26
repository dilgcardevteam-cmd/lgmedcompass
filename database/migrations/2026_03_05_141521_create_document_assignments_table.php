<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('document_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained()->onDelete('cascade');
            $table->foreignId('assigned_to_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('workflow_status')->default('Draft');
            $table->text('last_comment')->nullable();
            $table->timestamps();

            // Ensure only one assignment per document
            $table->unique('document_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_assignments');
    }
};
