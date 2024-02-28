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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('air_booking_id');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('from_hub_id')->nullable();
            $table->unsignedBigInteger('to_hub_id')->nullable();
            $table->string('destination_address')->nullable();
            $table->enum('status',['pickup_pending','assign_delivery_man','received_pickup_pending','delivery_hub','transit','return']);
            $table->timestamps();

            $table->foreign('air_booking_id')->references('id')->on('air_bookings')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('trackings');
        Schema::enableForeignKeyConstraints();
    }
};
