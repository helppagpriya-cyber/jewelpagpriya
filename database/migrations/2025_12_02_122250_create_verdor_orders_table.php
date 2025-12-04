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
        Schema::create('verdor_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // vendor
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=approved,2=processing,3=completed,4=cancelled');
            $table->date('order_date')->nullable();
            $table->decimal('sub_total', 16, 2)->default(0);
            $table->decimal('making_total', 16, 2)->default(0);
            $table->decimal('metal_value', 16, 2)->default(0); // rate*weight sum
            $table->decimal('discount', 16, 2)->default(0);
            $table->decimal('taxable_value', 16, 2)->default(0);
            $table->decimal('cgst', 10, 2)->default(0);
            $table->decimal('sgst', 10, 2)->default(0);
            $table->decimal('igst', 10, 2)->default(0);
            $table->decimal('total_amount', 16, 2)->default(0);
            $table->decimal('paid_amount', 16, 2)->default(0);
            $table->decimal('balance_amount', 16, 2)->default(0);
            $table->string('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete(); // admin who approved / created
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verdor_orders');
    }
};
