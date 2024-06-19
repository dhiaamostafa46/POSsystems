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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->string('nameAr');
            $table->string('nameEn');
            $table->string('opening_balance')->nullable();
            $table->string('available_balance');
            $table->string('vatNo')->nullable();
            $table->string('CR')->nullable();
            $table->string('logo');
            $table->integer('status')->default(1);
            $table->integer('isNew')->default(1);
            $table->integer('isPaid')->default(0);
            $table->integer('sectionID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
