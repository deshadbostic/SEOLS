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
/*         Schema::create('pv_system_template', function (Blueprint $table) {
            $table->id();

            $table->integer('energy_generated');
            $table->decimal('equipment_cost');
            $table->timestamps();
        }); */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pv_system_template');
    }
};
