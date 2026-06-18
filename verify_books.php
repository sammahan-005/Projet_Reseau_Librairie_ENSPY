<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

$books = Book::all();
$disk = Storage::disk('public');

foreach ($books as $book) {
    if (!$book->pdf_path) {
        echo "Book ID {$book->id} ('{$book->title}') has no PDF path.\n";
        continue;
    }
    
    if ($disk->exists($book->pdf_path)) {
        echo "Book ID {$book->id} ('{$book->title}'): PDF exists at '{$book->pdf_path}'.\n";
    } else {
        echo "Book ID {$book->id} ('{$book->title}'): ERROR - File does not exist at '{$book->pdf_path}'.\n";
    }
}
