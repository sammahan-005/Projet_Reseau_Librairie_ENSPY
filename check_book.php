<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$book = App\Models\Book::find(1);
if (!$book) {
    echo "BOOK_NOT_FOUND\n";
    exit;
}
echo json_encode($book->toArray(), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
