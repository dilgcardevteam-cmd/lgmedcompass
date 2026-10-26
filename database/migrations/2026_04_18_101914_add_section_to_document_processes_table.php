<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('document_processes', function (Blueprint $table) {
            // Add column AFTER assigned_to_id or wherever suitable
            $table->unsignedBigInteger('section')->nullable()->after('assigned_to_id');
            $table->foreign('section')->references('id')->on('sections')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('document_processes', function (Blueprint $table) {
            $table->dropForeign(['section']);
            $table->dropColumn('section');
        });
    }
};
