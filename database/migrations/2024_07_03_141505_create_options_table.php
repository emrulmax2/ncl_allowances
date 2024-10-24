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

        Schema::table('options', function (Blueprint $table) {
            
            $table->string('category', 190)->after('fieldvalue')->nullable();
            $table->unsignedBigInteger('created_by')->after('category')->nullable();
            $table->unsignedBigInteger('updated_by')->after('created_by')->nullable();
            $table->unsignedBigInteger('ID')->change();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropTimestamps();
            $table->dropSoftDeletes();
            $table->integer('ID')->change();
        });
    }
};
