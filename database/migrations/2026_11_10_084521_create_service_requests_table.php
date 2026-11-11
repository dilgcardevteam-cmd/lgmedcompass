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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requester_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('requester_name');
            $table->string('office_address');
            $table->string('contact_number', 40);
            $table->string('email');
            $table->string('service_type');
            $table->string('subject');
            $table->text('description');
            $table->timestamp('requested_at');
            $table->date('date_needed');
            $table->text('document_link')->nullable();
            $table->string('attachment_path')->nullable();
            $table->string('attachment_name')->nullable();
            $table->string('status')->default('Received')->index();
            $table->timestamps();

            $table->index(['requester_user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
