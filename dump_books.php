<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$books = App\Models\Book::limit(5)->get();
foreach ($books as $b) {
    echo "ID: {$b->id} - title: {$b->title} - pdf: {$b->pdf_path}\n";
}
if ($books->isEmpty()) echo "NO_BOOKS\n";
