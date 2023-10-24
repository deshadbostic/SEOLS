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
        
        Schema::create('house_info', function (Blueprint $table) {
            $table->string('customer_fName');
            $table->string('customer_lName');
            $table->integer('electricity_usage');
            $table->integer('roof_size');
            $table->integer('roof_slope');
            $table->integer('roof_age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_info');
    }
};
