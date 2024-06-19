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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('orgID');
            $table->integer('empID');
            $table->integer('salID');
            $table->json('allowns');
            $table->json('deducts');
            $table->double('fullAllowns');
            $table->double('fullDeducts');
            $table->double('netSalary');
            $table->string('month');
            
     
            $table->integer('Status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
