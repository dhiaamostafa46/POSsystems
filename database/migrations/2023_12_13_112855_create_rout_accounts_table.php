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
        Schema::create('rout_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Customers');
            $table->string('Suppliers');
            $table->string('Store');
            $table->string('Bank');
            $table->integer('treasury');
            $table->integer('sales');
            $table->boolean('purchases');

            $table->integer('Profitloss');
            $table->string('Salesreturns');
            $table->integer('Purchreturns');


            $table->string('Discountearned');
            $table->integer('Discountpermitted');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rout_accounts');
    }
};
