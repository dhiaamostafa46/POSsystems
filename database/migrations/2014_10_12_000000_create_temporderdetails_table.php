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
        Schema::create('temporderdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('orgID');
            $table->integer('branchID');
            $table->integer('productID');
            $table->string('productName');
            $table->integer('userID');
            $table->integer('orderID');
            $table->float('price');
            $table->float('quantity');
            $table->float('total');
            $table->float('totalcost');
            $table->float('discount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};
