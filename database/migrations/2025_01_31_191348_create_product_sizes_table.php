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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('size');
            $table->integer('stock');
            $table->string('metal_weight')->nullable();
            $table->string('metal_purity')->nullable();
            $table->integer('metal_price')->default(0);
            $table->string('gemstone_weight')->nullable();
            $table->string('gemstone_purity')->nullable();
            $table->integer('gemstone_price')->default(0);
            $table->integer('num_of_gemstone')->nullable();
            $table->integer('making_charges')->default(0);
            $table->integer('gst')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
