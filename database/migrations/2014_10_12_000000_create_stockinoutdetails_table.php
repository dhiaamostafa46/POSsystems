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
        Schema::create('stockinoutdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('orgID');
            $table->integer('branchID');
            $table->integer('productID');
            $table->integer('userID');
            $table->integer('stockinoutID');
            $table->float('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockinoutdetails');
    }
};
