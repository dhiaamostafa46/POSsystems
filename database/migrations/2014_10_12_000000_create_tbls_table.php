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
        Schema::create('tbls', function (Blueprint $table) {
            $table->id();
            $table->integer('orgID');
            $table->integer('branchID');
            $table->integer('userID');
            $table->string('tableNo');
            $table->integer('status')->default(1);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbls');
    }
};
