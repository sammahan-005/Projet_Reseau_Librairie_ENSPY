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
            $table->integer('hours');
            $table->date('start_date');
            $table->integer('daily_frequency');
            $table->enum('type', ['Beginner', 'Professional', 'Premium']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            //$table->foreignId('payment_id')->constrained('payments')->onDelete('cascade');
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
