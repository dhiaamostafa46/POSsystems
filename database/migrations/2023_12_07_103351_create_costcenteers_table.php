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
        Schema::create('costcenteers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('CostName');
            $table->string('CostNameEN');
            $table->string('CostCodeID');
            $table->date('dataCost');
            $table->interger('MainCost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costcenteers');
    }
};
