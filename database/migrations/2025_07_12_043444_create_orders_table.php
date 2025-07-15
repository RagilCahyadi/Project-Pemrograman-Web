<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamp('order_date')->useCurrent();
            $table->unsignedBigInteger('sub_total_amount');
            $table->unsignedBigInteger('discount_amount')->default(0);
            $table->unsignedBigInteger('grand_total_amount');
            $table->boolean('is_paid')->default(false);
            $table->string('booking_trx_id', 100)->nullable()->unique();
            $table->foreignId('promo_code_id')->nullable()->constrained('promo_codes');
            $table->foreignId('shipping_id')->constrained('shipping');
            $table->string('tracking_number', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('orders');
    }
};