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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('orgID');
            $table->integer('userID');
            $table->integer('categoryID');
            $table->integer('kitchenID')->nullable();
            $table->string('barcode');
            $table->string('nameAr');
            $table->string('nameEn')->nullable();
            $table->float('costPrice');
            $table->float('prodPrice');
            $table->float('vat');
            $table->integer('isParent')->default(0);
            $table->integer('parentID')->nullable();
            $table->integer('unitID')->nullable();
            $table->time('sFrom')->nullable();
            $table->time('sTo')->nullable();
            $table->string('img');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
