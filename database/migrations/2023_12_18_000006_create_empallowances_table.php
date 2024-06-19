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
        Schema::create('empallowances', function (Blueprint $table) {
            $table->id();
            $table->integer('empID');
      
            $table->string('allowID');
            $table->double('value')->default(0);;
          
            $table->integer('Status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empallowances');
    }
};
