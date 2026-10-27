<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn(['from', 'recipient_name', 'requesting_office']);
        });
    }

    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('from')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('requesting_office')->default('N/A');
        });
    }
};
