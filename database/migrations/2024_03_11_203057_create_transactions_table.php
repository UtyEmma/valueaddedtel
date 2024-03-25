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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference')->unique();
            $table->string('payment_method_code');
            $table->string('user_id');
            $table->string('type');
            $table->string('flow');
            $table->string('currency_code');
            $table->uuidMorphs('transactable');
            $table->string('amount');
            $table->text('narration');
            $table->string('status');
            $table->integer('old_bal')->nullable();
            $table->integer('new_bal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
