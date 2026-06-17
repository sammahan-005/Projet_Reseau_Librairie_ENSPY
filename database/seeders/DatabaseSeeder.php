<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\book;
use Database\Seeders\AdminUserSeeder;
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

        // Create a basic test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create the admin user (idempotent)
        $this->call(AdminUserSeeder::class);

        $books = [
            ['title' => 'La Science du Chaos',     'author' => 'Emmanuel Dibonge',  'genre' => 'roman',          'cover_image' => 'covers/nature.jpg'],
            ['title' => 'Le Guide Culinaire',       'author' => 'Gaëtan Dissomme',   'genre' => 'roman',          'cover_image' => 'covers/cook1.jpg'],
            ['title' => 'Classiques',               'author' => 'Cassan de Stainmo', 'genre' => 'roman',          'cover_image' => 'covers/magazine1.jpg'],
            ['title' => 'La Photographie Créative', 'author' => 'Cassan de Stainmo', 'genre' => 'roman',          'cover_image' => 'covers/art.jpg'],
            ['title' => 'Le Secret Quantique',      'author' => 'Emmanuel Dibonge',  'genre' => 'science-fiction','cover_image' => 'covers/science2.jpg'],
            ['title' => 'La Photographie Créative', 'author' => 'Cassan de Stainmo', 'genre' => 'roman',          'cover_image' => 'covers/culture.jpg'],
            ['title' => 'Le Guide Culinaire',       'author' => 'Gaëtan Dissomme',   'genre' => 'roman',          'cover_image' => 'covers/doc1.jpg'],
            ['title' => 'La Science du Chaos',      'author' => 'Emmanuel Dibonge',  'genre' => 'roman',          'cover_image' => 'covers/politique2.jpg'],
        ];

        foreach ($books as $book) {

            Book::create(array_merge($book, [
                'published_year' => '2024-01-01',
                'pdf_path'       => 'books/placeholder.pdf',
            ]));
        }
    }
}
