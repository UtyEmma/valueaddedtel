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
        Schema::create('vtu_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('transaction_id')->nullable();
            $table->string('service_code');
            $table->string('user_id');
            $table->integer('amount');
            $table->string('provider_code');
            $table->string('country_code');
            $table->string('currency_code');
            $table->string('narration');
            $table->string('mode');
            $table->json('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vtu_histories');
    }
};
