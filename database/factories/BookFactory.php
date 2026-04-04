<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'title'          => ucfirst(fake('fr_FR')->words(4, true)),
        'author'         => fake('fr_FR')->name(),
        'isbn'           => fake()->unique()->isbn13(),
        'published_year' => fake()->numberBetween(1950, 2024),
        'genre'          => fake()->randomElement([
            'Roman', 'Poême', 'Théâtre', 'Science-fiction', 'Roman-policier', 'Bande-dessinée','Fiction', 'Non-Fiction', 'Fantasie', 'Mystère', 'Biographie'
        ]),
    ];
}
}
