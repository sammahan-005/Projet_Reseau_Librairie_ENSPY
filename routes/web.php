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
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    // Library page for authenticated users (named route used by LoginResponse)
    Route::get('library', [App\Http\Controllers\LibraryController::class, 'index'])->name('library');
    Route::get('books/{book}/read', [App\Http\Controllers\BookController::class, 'read'])->name('books.read');
    Route::post('subscriptions/simulate', [App\Http\Controllers\SubscriptionController::class, 'simulate'])->name('subscriptions.simulate');
    Route::post('subscriptions/update-remaining', [App\Http\Controllers\SubscriptionController::class, 'updateRemaining'])->name('subscription.update-remaining');
});

// Reader history (sessions list)
Route::middleware(['auth'])->group(function () {
    Route::get('/history', [App\Http\Controllers\ReaderHistoryController::class, 'index'])->name('history.index');
});

// Admin backoffice routes (auth + admin middleware)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('admin.dashboard');
    Route::get('/catalog', [App\Http\Controllers\Admin\CatalogController::class, 'index'])->name('admin.catalog.index');
    Route::get('/catalog/create', [App\Http\Controllers\Admin\CatalogController::class, 'create'])->name('admin.catalog.create');
    Route::get('/catalog/{id}/edit', [App\Http\Controllers\Admin\CatalogController::class, 'edit'])->name('admin.catalog.edit');
    Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('admin.users.edit');
    Route::get('/plans', [App\Http\Controllers\Admin\PlansController::class, 'index'])->name('admin.plans.index');
    Route::get('/notifications', [App\Http\Controllers\Admin\NotificationsController::class, 'index'])->name('admin.notifications.index');
    
    // Admin API endpoints for CRUD
    Route::post('/api/books', [App\Http\Controllers\Admin\Api\BooksController::class, 'store'])->name('admin.api.books.store');
    Route::put('/api/books/{id}', [App\Http\Controllers\Admin\Api\BooksController::class, 'update'])->name('admin.api.books.update');
    Route::delete('/api/books/{id}', [App\Http\Controllers\Admin\Api\BooksController::class, 'destroy'])->name('admin.api.books.destroy');

    Route::post('/api/categories', [App\Http\Controllers\Admin\Api\CategoriesController::class, 'store'])->name('admin.api.categories.store');
    Route::put('/api/categories/{id}', [App\Http\Controllers\Admin\Api\CategoriesController::class, 'update'])->name('admin.api.categories.update');
    Route::delete('/api/categories/{id}', [App\Http\Controllers\Admin\Api\CategoriesController::class, 'destroy'])->name('admin.api.categories.destroy');

    Route::post('/users/{id}/suspend', [App\Http\Controllers\Admin\UsersController::class, 'suspend'])->name('admin.users.suspend');
    Route::post('/users/{id}/unsuspend', [App\Http\Controllers\Admin\UsersController::class, 'unsuspend'])->name('admin.users.unsuspend');
    Route::delete('/users/{id}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('admin.users.destroy');
});


require __DIR__.'/settings.php';

// Route::post('/inscription', ['App\Http\Controllers\AuthController', 'register'])->name('auth.register')->middleware('guest');

// Route::post('/connexion', ['App\Http\Controllers\AuthController', 'login'])->name('auth.login')->middleware('guest');

// Route::delete('/logout', ['App\Http\Controllers\AuthController', 'logout'])->name('auth.logout')->middleware('auth');

Route::resource('books', App\Http\Controllers\BookController::class);

Route::post('/payments/{id}', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.store');

Route::resource('payments', App\Http\Controllers\PaymentController::class)->except('store');

Route::get('/subcriptions/index', [App\Http\Controllers\SubscriptionController::class, 'index'])->name('subscription.index');

Route::get('/subscriptions/create', [App\Http\Controllers\SubscriptionController::class, 'create'])->name('subscription.create');

Route::post('/subscriptions/store', [App\Http\Controllers\SubscriptionController::class, 'store'])->name('subscription.store');

Route::get('/consultation/{id}', [App\Http\Controllers\ConsultationController::class, 'consultation'])->name('consultation.consultation');

Route::post('/endConsultation/{id}', [App\Http\Controllers\ConsultationController::class, 'endConsultation'])->name('consultation.endConsultation');
