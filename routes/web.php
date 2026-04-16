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

// Route::post('/inscription', ['App\Http\Controllers\authController', 'register'])->name('auth.register')->middleware('guest');

// Route::post('/connexion', ['App\Http\Controllers\authController', 'login'])->name('auth.login')->middleware('guest');

// Route::delete('/logout', ['App\Http\Controllers\authController', 'logout'])->name('auth.logout')->middleware('auth');

Route::resource('books', 'App\Http\Controllers\bookController');

Route::post('/paiements/{id}', ['App\Http\Controllers\paiementController', 'store'])->name('paiement.store');

Route::resource('paiements','App\Http\Controllers\paiementController')->except('store');

Route::get('/subcriptions/index',['App\Http\Controllers\subscriptionController','index'])->name('subscription.index');

Route::get('/subscriptions/create',['App\Http\Controllers\subscriptionController','create'])->name('subscription.create');

Route::post('/subscriptions/store',['App\Http\Controllers\subscriptionController','store'])->name('subscription.store');

Route::get('/consultation/{id}',['App\Http\Controllers\consultationController','consultation'])->name('consultation.consultation');

Route::post('/endConsultation/{id}',['App\Http\Controllers\consultationController','endConsultation'])->name('consultation.endConsultation');