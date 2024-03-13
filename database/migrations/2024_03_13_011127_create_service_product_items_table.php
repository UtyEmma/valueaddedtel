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
        Schema::create('service_product_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('service_product_code');
            $table->string('name');
            $table->string('shortcode');
            $table->json('meta')->nullable();
            $table->integer('amount')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_product_items');
    }
};
