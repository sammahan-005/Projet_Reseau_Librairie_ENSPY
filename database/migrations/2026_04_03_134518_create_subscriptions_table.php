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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('duration');
            $table->integer('price');
            $table->integer('hours')->nullable();
            $table->date('date');
            $table->date('start_date')->nullable();
            $table->integer('daily_frequency')->nullable();
            $table->enum('type', ['standard', 'medium', 'Premium'])->default('standard')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // payment is stored in the `payments` table and references subscriptions (created later)
            // to avoid circular foreign key constraints we don't add a payment_id here.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
