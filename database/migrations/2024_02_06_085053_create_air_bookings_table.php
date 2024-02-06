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
            // $table->string('invoice_no');
            // $table->unsignedBigInteger('agency_id');
            // $table->unsignedBigInteger('destination_id');
            // $table->unsignedBigInteger('area_type_id');
            // $table->unsignedBigInteger('wight_id');
            // $table->unsignedBigInteger('parcel_type_id');
            // $table->unsignedBigInteger('delivery_type_id');
            // $table->string('from_name');
            // $table->string('from_number');
            // $table->string('from_address');
            // $table->string('to_name');
            // $table->string('to_number');
            // $table->string('to_address');
            // $table->longText('product_details');
            // $table->float('product_amount');
            // $table->float('collection_amount');
            // $table->float('due_amount');
            // $table->float('delivery_charge');
            // $table->longText('spacial_instruction');
            // $table->dateTime('date_time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_bookings');
    }
};