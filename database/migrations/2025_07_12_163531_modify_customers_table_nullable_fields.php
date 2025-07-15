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
        Schema::table('customers', function (Blueprint $table) {
            // Make city and post_code nullable
            $table->string('city', 45)->nullable()->change();
            $table->integer('post_code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Revert back to not nullable
            $table->string('city', 45)->nullable(false)->change();
            $table->integer('post_code')->nullable(false)->change();
        });
    }
};
