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
        Schema::create('inverter', function (Blueprint $table) {
            $table->id();
            $table->string("Model");
            $table->integer("InputPowerWatts");
            $table->integer("OutputPowerWatts");
            $table->string("SizeInches");
            $table->string("FrequencyHz");
            $table->decimal("Efficiency", 5, 2);
            $table->decimal("Cost", 10, 2);
            $table->timestamps(0);
        });

        Schema::create('solar_panel', function (Blueprint $table) {
            $table->id();
            $table->string("Model");
            $table->string("Warranty");
            $table->string("Durability");
            $table->decimal("Cost", 10, 2);
            $table->integer("EnergyOutputWatts");
            $table->string("DimensionsInches");
            $table->timestamps(0);
        });

        Schema::create('battery', function (Blueprint $table) {
            $table->id();
            $table->string("Model");
            $table->decimal("CapacityAh", 6, 2);
            $table->string("VoltageV");
            $table->integer("RatingWh");
            $table->decimal("WeightLbs", 5, 1);
            $table->decimal("Cost", 10, 2);
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inverter');
        Schema::dropIfExists('solar_panels');
        Schema::dropIfExists('battery');
    }
};
