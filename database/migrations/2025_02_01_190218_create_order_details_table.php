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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('product_size_id')->nullable()->constrained();
            $table->foreignId('product_discount_id')->nullable()->constrained();
            $table->integer('quantity');
            $table->integer('price')->nullable();
            $table->boolean('is_express_delivery')->default(false)->comment('0=No, 1=Yes');
            $table->integer('delivery_charges')->nullable();
            $table->boolean('is_gifted')->default(false)->comment('0=No, 1=Yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
