<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Inertia\Inertia;


// Home page served by Book controller to show list of books
Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('home');

// Keep /home consistent with root which is handled by BookController@index (renders 'Home')
Route::get('/home', function () {
    return redirect()->route('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
    
    // Library page for authenticated users (named route used by LoginResponse)
    Route::get('library', [App\Http\Controllers\LibraryController::class, 'index'])->name('library');
});


require __DIR__.'/settings.php';

// Route::post('/inscription', ['App\Http\Controllers\AuthController', 'register'])->name('auth.register')->middleware('guest');

// Route::post('/connexion', ['App\Http\Controllers\AuthController', 'login'])->name('auth.login')->middleware('guest');

// Route::delete('/logout', ['App\Http\Controllers\AuthController', 'logout'])->name('auth.logout')->middleware('auth');

Route::resource('books', App\Http\Controllers\BookController::class);

Route::post('/paiements/{id}', [App\Http\Controllers\PaiementController::class, 'store'])->name('paiement.store');

Route::resource('paiements', App\Http\Controllers\PaiementController::class)->except('store');

Route::get('/subcriptions/index', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription.index');

Route::get('/subscriptions/create', [App\Http\Controllers\SubscriptionController::class, 'create'])->name('subscription.create');

Route::post('/subscriptions/store', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscription.store');

Route::get('/consultation/{id}', [App\Http\Controllers\ConsultationController::class, 'consultation'])->name('consultation.consultation');

Route::post('/endConsultation/{id}', [App\Http\Controllers\ConsultationController::class, 'endConsultation'])->name('consultation.endConsultation');
