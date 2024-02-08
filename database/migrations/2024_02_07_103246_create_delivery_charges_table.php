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
        Schema::create('delivery_charges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_type_id');
            $table->unsignedBigInteger('parcel_type_id');
            $table->unsignedBigInteger('delivery_type_id');
            $table->string('weight');
            $table->float('delivery_charge');
            $table->enum('status',['active','inactive','suspend'])->default('active');
            $table->timestamps();
            $table->foreign('area_type_id')->references('id')->on('area_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parcel_type_id')->references('id')->on('parcel_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('delivery_type_id')->references('id')->on('delivery_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('delivery_charges');
        Schema::enableForeignKeyConstraints();
    }
};
