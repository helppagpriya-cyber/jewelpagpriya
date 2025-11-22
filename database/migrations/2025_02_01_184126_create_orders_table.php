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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('status',['pending','shipped','delivered','cancelled'])->default('pending');
            $table->date('shipped_date')->nullable();
            $table->date('delivered_date')->nullable();
            $table->string('payment_mode')->default('COD');
            $table->enum('payment_status',['pending','done'])->default('pending');
            $table->foreignId('user_address_id')->constrained();
            $table->string('tracking_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
