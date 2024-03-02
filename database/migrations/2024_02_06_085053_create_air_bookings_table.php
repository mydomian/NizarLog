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
            $table->unsignedBigInteger('last_destination_id');
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
            $table->float('cod_charge');
            $table->float('delivery_charge');
            $table->longText('spacial_instruction');
            $table->longText('return_reson')->nullable();
            $table->dateTime('date_time');
            $table->enum('status',['pickup_pending','assign_delivery_man','received_pickup_pending','delivery_hub','transit','delivery','return','transit_received','transit_delivered'])->default('pickup_pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('last_destination_id')->references('id')->on('hubs')->onUpdate('cascade')->onDelete('cascade');
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
