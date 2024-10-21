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
        Schema::table('users', function (Blueprint $table) {
            $table->rememberToken()->after('password');
            $table->string('email')->unique()->nullable()->after('remember_token');
            $table->string('name')->after('email')->nullable();
            $table->unsignedBigInteger('created_by')->after('name')->nullable();
            $table->unsignedBigInteger('updated_by')->after('created_by')->nullable();
            $table->unsignedBigInteger('ID')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('remember_token');
            $table->dropColumn('email');
            $table->dropColumn('name');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->integer('ID')->change();
        });
    }
};
