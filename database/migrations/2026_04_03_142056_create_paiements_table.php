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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method');
            $table->integer('amount');
            $table->date('payment_date');
            // use ASCII status values to avoid encoding/locale issues
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->foreignId('subscription_id')->constrained('subscriptions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::dropIfExists('payments');
    }
};
