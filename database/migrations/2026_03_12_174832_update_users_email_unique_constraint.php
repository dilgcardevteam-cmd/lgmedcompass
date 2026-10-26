<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if ($this->indexExists('users', 'users_email_unique')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->dropUnique('users_email_unique');
            });
        }

        if (! Schema::hasColumn('users', 'active_email')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->string('active_email')->storedAs('IF(deleted_at IS NULL, email, NULL)');
            });
        }

        if (! $this->indexExists('users', 'users_active_email_unique')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->unique('active_email', 'users_active_email_unique');
            });
        }
    }

    public function down(): void
    {
        if ($this->indexExists('users', 'users_active_email_unique')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->dropUnique('users_active_email_unique');
            });
        }

        if (Schema::hasColumn('users', 'active_email')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->dropColumn('active_email');
            });
        }

        if (! $this->indexExists('users', 'users_email_unique')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->unique('email');
            });
        }
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $databaseName = DB::getDatabaseName();

        $result = DB::selectOne(
            'SELECT COUNT(*) AS aggregate
             FROM information_schema.statistics
             WHERE table_schema = ?
               AND table_name = ?
               AND index_name = ?',
            [$databaseName, $table, $indexName]
        );

        return (int) ($result->aggregate ?? 0) > 0;
    }
};
