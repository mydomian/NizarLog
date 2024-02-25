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
        Schema::create('cod_charges', function (Blueprint $table) {
            $table->id();
            $table->float('charge_percent');
            $table->enum('type',['desk_booking','agency']);
            $table->enum('status',['active','inactive','suspend'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cod_charges');
    }
};
