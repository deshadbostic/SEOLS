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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('solar_panel_id')->referenced('id')->on('products')->cascadeOnDelete();
            $table->integer('solar_panel_count');
            $table->foreignId('battery_id')->nullable()->referenced('id')->on('products')->cascadeOnDelete();
            $table->integer('battery_count')->nullable();
            $table->foreignId('inverter_id')->referenced('id')->on('products')->cascadeOnDelete();
            $table->integer('inverter_count');
            $table->foreignId('wire_id')->referenced('id')->on('products')->cascadeOnDelete();
            $table->integer('wire_count');
            $table->integer('energy_generated');
            $table->float('equipment_cost');
            $table->float('installation_cost');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
