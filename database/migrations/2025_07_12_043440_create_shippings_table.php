<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->string('courier', 45);
            $table->unsignedBigInteger('shipping_cost');
            $table->string('estimated_delivery', 20);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('shipping');
    }
};