<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->string('payment_method', 50); // e.g., 'credit_card', 'paypal', 'bank_transfer'
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->unsignedBigInteger('amount');
            $table->string('transaction_id', 100)->nullable()->unique();
            $table->string('payment_gateway', 50)->nullable(); // e.g., 'stripe', 'paypal'
            $table->timestamp('payment_date')->nullable();
            $table->json('payment_details')->nullable(); // Store additional payment info
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('payments');
    }
};