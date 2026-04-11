<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;


Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});


require __DIR__.'/settings.php';

Route::post('/inscription', ['App\Http\Controllers\authController', 'register'])->name('auth.register')->middleware('guest');

Route::post('/connexion', ['App\Http\Controllers\authController', 'login'])->name('auth.login')->middleware('guest');

Route::delete('/logout', ['App\Http\Controllers\authController', 'logout'])->name('auth.logout')->middleware('auth');

Route::resource('books', 'App\Http\Controllers\bookController')->middleware('auth');
