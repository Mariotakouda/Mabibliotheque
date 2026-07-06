<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// --- Guest-only auth routes ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:10,1')
        ->name('login.attempt');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])
        ->middleware('throttle:5,1');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// --- Authenticated routes ---
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Every logged-in user can manage their own profile.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Catalogue: any authenticated user may browse.
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
    Route::resource('books', BookController::class)->only(['index', 'show']);

    // Borrowings: everyone can see the list (scoped to their own borrowings if
    // they are a plain "user" — see BorrowingController@index) and view details
    // of their own borrowing.
    Route::resource('borrowings', BorrowingController::class)->only(['index', 'show']);

    // --- Staff-only (admin + librarian): manage the catalogue and borrowings ---
    Route::middleware('role:admin,librarian')->group(function () {
        Route::resource('categories', CategoryController::class)->except(['index', 'show']);
        Route::resource('books', BookController::class)->except(['index', 'show']);
        Route::resource('borrowings', BorrowingController::class)->except(['index', 'show']);
        Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
            ->name('borrowings.return');
    });

    // --- Admin-only: manage user accounts and roles ---
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});
