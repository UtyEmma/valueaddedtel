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
        Schema::create('package_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('package_id');
            $table->string('user_id');
            $table->string('fee');
            $table->string('currency_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_histories');
    }
};
