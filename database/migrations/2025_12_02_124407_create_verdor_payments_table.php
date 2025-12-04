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
        Schema::create('verdor_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_order_id')->nullable()->constrained('vendor_orders')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // vendor
            $table->decimal('amount', 16, 2)->default(0);
            $table->string('payment_mode')->nullable(); // cash, upi, bank, etc
            $table->date('payment_date')->nullable();
            $table->string('reference')->nullable(); // txn id
            $table->string('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete(); // admin or vendor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verdor_payments');
    }
};
