<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Storage;
$disk = Storage::disk('public');
$path = 'books/6YSRkKyz1EVD0VrhMMVQInJQXyvzrqDN6ZlrkJSI.pdf';

if ($disk->exists($path)) {
    echo "File exists!\n";
} else {
    echo "File does not exist in disk root: " . config('filesystems.disks.public.root') . "\n";
}
