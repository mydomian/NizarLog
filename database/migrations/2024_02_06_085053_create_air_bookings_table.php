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
        Schema::create('air_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_area_id');
            $table->unsignedBigInteger('area_type_id');
            $table->unsignedBigInteger('parcel_type_id');
            $table->unsignedBigInteger('delivery_type_id');
            $table->unsignedBigInteger('delivery_charge_id');
            $table->string('from_name');
            $table->string('from_number');
            $table->string('from_address');
            $table->string('to_name');
            $table->string('to_number');
            $table->string('to_address');
            $table->longText('product_details');
            $table->float('product_amount');
            $table->float('collection_amount');
            $table->float('due_amount');
            $table->float('delivery_charge');
            $table->longText('spacial_instruction');
            $table->dateTime('date_time');
            $table->enum('status',['pickup_pending','received_pickup_pending','received_delivery_hub','in_transit','delivered','return','cancel'])->default('pickup_pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('service_area_id')->references('id')->on('service_areas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('area_type_id')->references('id')->on('area_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parcel_type_id')->references('id')->on('parcel_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('delivery_type_id')->references('id')->on('delivery_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('delivery_charge_id')->references('id')->on('delivery_charges')->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('air_bookings');
        Schema::enableForeignKeyConstraints();
    }
};
