<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $books = [
            ['title' => 'La Science du Chaos',     'author' => 'Emmanuel Dibonge',  'genre' => 'roman',          'cover_image' => null],
            ['title' => 'Le Guide Culinaire',       'author' => 'Gaëtan Dissomme',   'genre' => 'roman',          'cover_image' => null],
            ['title' => 'Classiques',               'author' => 'Cassan de Stainmo', 'genre' => 'roman',          'cover_image' => null],
            ['title' => 'La Photographie Créative', 'author' => 'Cassan de Stainmo', 'genre' => 'roman',          'cover_image' => null],
            ['title' => 'Le Secret Quantique',      'author' => 'Emmanuel Dibonge',  'genre' => 'science-fiction','cover_image' => null],
            ['title' => 'La Photographie Créative', 'author' => 'Cassan de Stainmo', 'genre' => 'roman',          'cover_image' => null],
            ['title' => 'Le Guide Culinaire',       'author' => 'Gaëtan Dissomme',   'genre' => 'roman',          'cover_image' => null],
            ['title' => 'La Science du Chaos',      'author' => 'Emmanuel Dibonge',  'genre' => 'roman',          'cover_image' => null],
        ];

        foreach ($books as $book) {

            Book::create(array_merge($book, [
                'published_year' => '2024-01-01',
                'pdf_path'       => 'books/placeholder.pdf',
            ]));
        }
    }
}
