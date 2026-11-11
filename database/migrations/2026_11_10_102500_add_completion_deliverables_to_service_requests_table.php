<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table): void {
            $table->text('deliverable_link')->nullable();
        });

        Schema::create('service_request_deliverables', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('service_request_id')
                ->constrained('service_requests')
                ->cascadeOnDelete();
            $table->string('file_path');
            $table->string('file_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_request_deliverables');

        Schema::table('service_requests', function (Blueprint $table): void {
            $table->dropColumn('deliverable_link');
        });
    }
};
