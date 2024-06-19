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
        Schema::create('journal_subs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nameAccount');
            $table->string('CodeAccount');
            $table->string('Debit');
            $table->string('Credit');
            $table->text('dec');
            $table->string('CostCenter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_subs');
    }
};
