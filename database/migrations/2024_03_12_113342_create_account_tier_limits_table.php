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
        Schema::create('account_tier_limits', function (Blueprint $table) {
            $table->id();
            $table->integer('service_code');
            $table->integer('country_code');
            $table->integer('daily_limit');
            $table->integer('lifetime_limit')->nullable();
            $table->integer('single_limit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_tier_limits');
    }
};
