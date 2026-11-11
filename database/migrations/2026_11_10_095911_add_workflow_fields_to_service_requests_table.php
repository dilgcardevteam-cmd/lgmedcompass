<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->foreignId('assigned_to_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('claimed_at')->nullable();
            $table->text('last_comment')->nullable();
            $table->text('tracking_token')->nullable();
            $table->string('tracking_token_hash', 64)->nullable()->unique();
        });

        Schema::table('service_requests', function (Blueprint $table): void {
            $table->dropIndex(['status']);
        });

        Schema::table('service_requests', function (Blueprint $table): void {
            $table->string('status')->default('Received')->change();
            $table->index('status');
        });

        DB::table('service_requests')
            ->where('status', 'Unassigned')
            ->update(['status' => 'Received']);

        DB::table('service_requests')
            ->whereNull('tracking_token_hash')
            ->orderBy('id')
            ->get(['id'])
            ->each(function (object $serviceRequest): void {
                $token = Str::random(64);

                DB::table('service_requests')
                    ->where('id', $serviceRequest->id)
                    ->update([
                        'tracking_token' => Crypt::encryptString($token),
                        'tracking_token_hash' => hash('sha256', $token),
                    ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropUnique(['tracking_token_hash']);
            $table->dropConstrainedForeignId('assigned_to_id');
            $table->dropColumn([
                'claimed_at',
                'last_comment',
                'tracking_token',
                'tracking_token_hash',
            ]);
        });

        Schema::table('service_requests', function (Blueprint $table): void {
            $table->dropIndex(['status']);
        });

        Schema::table('service_requests', function (Blueprint $table): void {
            $table->string('status')->default('Unassigned')->change();
            $table->index('status');
        });
    }
};
