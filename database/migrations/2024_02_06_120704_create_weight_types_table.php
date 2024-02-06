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
        Schema::create('weight_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('delivery_type_id');
            $table->string('type');
            $table->float('charge');
            $table->enum('status',['active','inactive','suspend'])->default('active');
            $table->timestamps();
            $table->foreign('delivery_type_id')->references('id')->on('delivery_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('weight_types');
        Schema::enableForeignKeyConstraints();
    }
};
