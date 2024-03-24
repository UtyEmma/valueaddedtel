<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('purchases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->string('transaction_id')->nullable();
            $table->string('reference');
            $table->string('service_code');
            $table->integer('amount');
            $table->string('provider_code');
            $table->string('country_code');
            $table->string('narration');
            $table->string('product_code')->nullable();
            $table->string('product_item_code')->nullable();
            $table->string('mode');
            $table->json('meta');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('purchases');
    }
};
