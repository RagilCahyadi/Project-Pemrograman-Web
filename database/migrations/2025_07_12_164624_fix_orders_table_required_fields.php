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
            // Fix sub_total_amount to have default value
            $table->decimal('sub_total_amount', 10, 2)->default(0.00)->change();
            
            // Fix grand_total_amount to have default value  
            $table->decimal('grand_total_amount', 10, 2)->default(0.00)->change();
            
            // Make shipping_id nullable since not all orders need shipping
            $table->unsignedBigInteger('shipping_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Reverse the changes
            $table->decimal('sub_total_amount', 10, 2)->nullable(false)->change();
            $table->decimal('grand_total_amount', 10, 2)->nullable(false)->change();
            $table->unsignedBigInteger('shipping_id')->nullable(false)->change();
        });
    }
};
