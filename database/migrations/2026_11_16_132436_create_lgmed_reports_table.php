<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lgmed_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('item_no')->nullable();
            $table->text('ppa');
            $table->string('frequency')->nullable()->index();
            $table->text('timelines')->nullable();
            $table->text('focal_person')->nullable();
            $table->string('section')->nullable()->index();
            $table->text('mode_of_submission')->nullable();
            $table->text('monitoring_link')->nullable();
            $table->string('end_user_level')->nullable();
            $table->string('ppa_category')->nullable()->index();
            $table->text('legal_basis_reference')->nullable();
            $table->text('reference_link')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lgmed_reports');
    }
};
