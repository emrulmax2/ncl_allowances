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
        Schema::create('trip_allowance_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transport_point_id')->nullable();
            $table->string('transport_from',191);
            $table->string('transport_to',191);
            $table->double('trip_allowance');
            $table->double('oil_allowance');
            $table->text('remarks')->nullable();
            $table->timestamp('claimed_at');
            
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trip_allowance_details');
    }
};
