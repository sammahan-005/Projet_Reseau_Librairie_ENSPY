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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->unique();
            $table->enum('genre', ['Roman', 'Poême', 'Théâtre', 'Science-fiction', 'Roman-policier', 'Bande-dessinée','Fiction', 'Non-Fiction', 'Fantasie', 'Mystère', 'Biographie'])->default('Roman');
            $table->year('published_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_book');
    }
};
