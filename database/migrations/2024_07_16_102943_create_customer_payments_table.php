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
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('customer_orders')->onDelete('cascade');
            $table->double('project_cost');
            $table->enum('payment_type',['advance','final']);
            $table->double('amount');
            $table->string('pay_method');
            $table->string('tranjection_id');
            $table->string('pay_slip');
            $table->enum('status',['hold','accept','reject','refunded'])->default('hold');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_payments');
    }
};
