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
            $table->integer('durée');
            $table->integer('prix');
            $table->integer('nombre heure');
            $table->date('date debut');
            $table->integer('fréquence journalière');
            $table->enum('catégorie', ['Amateur', 'Professionnel', 'Premium']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paiement_id')->constrained('paiements')->onDelete('cascade');
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
