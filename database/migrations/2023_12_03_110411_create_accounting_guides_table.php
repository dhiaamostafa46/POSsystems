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
        Schema::create('accounting_guides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('AccountID');
            $table->string('AccountName');
            $table->string('AccountNameEn');
            $table->string('type');
            $table->integer('maxAccount');
            $table->integer('minAccount');
            $table->boolean('Account_Source');

            $table->integer('Account_status');
            $table->string('SourceID');
            $table->integer('typeProcsss');
            // $table->integer('debitAccount');
            // $table->integer('creditAccount');
            // $table->integer('BalanceAcount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_guides');
    }
};
