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
        Schema::table('orders', function (Blueprint $table) {
            // Add order detail columns
            $table->string('service_type')->default('fancy_paper')->after('customer_id');
            $table->string('product_type')->nullable()->after('service_type');
            $table->string('paper_type')->nullable()->after('product_type');
            $table->string('size')->nullable()->after('paper_type');
            $table->string('finishing')->nullable()->after('size');
            $table->integer('quantity')->default(1)->after('finishing');
            $table->decimal('unit_price', 10, 2)->default(0)->after('quantity');
            $table->decimal('subtotal_amount', 10, 2)->default(0)->after('unit_price');
            $table->decimal('shipping_cost', 10, 2)->default(0)->after('subtotal_amount');
            $table->decimal('tax_amount', 10, 2)->default(0)->after('shipping_cost');
            $table->string('shipping_method')->default('pickup')->after('tax_amount');
            $table->string('payment_method')->nullable()->after('shipping_method');
            $table->string('promo_code')->nullable()->after('payment_method');
            $table->text('notes')->nullable()->after('promo_code');
            $table->string('status')->default('pending')->after('notes');
            $table->string('payment_status')->default('pending')->after('status');
            
            // Update existing columns to use decimal
            $table->decimal('sub_total_amount', 10, 2)->change();
            $table->decimal('discount_amount', 10, 2)->default(0)->change();
            $table->decimal('grand_total_amount', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Remove added columns
            $table->dropColumn([
                'service_type',
                'product_type', 
                'paper_type',
                'size',
                'finishing',
                'quantity',
                'unit_price',
                'subtotal_amount',
                'shipping_cost',
                'tax_amount',
                'shipping_method',
                'payment_method',
                'promo_code',
                'notes',
                'status',
                'payment_status'
            ]);
            
            // Revert column types
            $table->unsignedBigInteger('sub_total_amount')->change();
            $table->unsignedBigInteger('discount_amount')->default(0)->change();
            $table->unsignedBigInteger('grand_total_amount')->change();
        });
    }
};
