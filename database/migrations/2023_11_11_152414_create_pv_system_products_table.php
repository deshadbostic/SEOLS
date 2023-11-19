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
        Schema::create('pv_system_products', function (Blueprint $table) {
            $table->foreignid('pv_system_id')->constrained()->cascadeOnDelete();
            $table->foreignid('product_id')->constrained()->cascadeOnDelete();
            $table->integer('product_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pv_system_products');
    }
};