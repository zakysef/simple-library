<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Default login route for middleware fallback
Route::get('/login', function () {
    // Redirect ke halaman login sesuai kebutuhan, misal ke admin
    return redirect()->route('admin.login');
})->name('login');

// Route /register hanya GET, redirect ke student.register
Route::get('/register', function () {
    return redirect()->route('student.register');
})->name('register');

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
});

// Student routes
Route::prefix('student')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login']);
    Route::get('/register', [StudentAuthController::class, 'showRegistrationForm'])->name('student.register');
    Route::post('/register', [StudentAuthController::class, 'register']); // <--- ini untuk proses POST register siswa
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::post('/student/borrow', [StudentDashboardController::class, 'borrow'])->name('student.borrow');
    Route::post('/student/return', [StudentDashboardController::class, 'returnBook'])->name('student.return');
});

// Admin protected routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/books', [AdminDashboardController::class, 'books'])->name('admin.books');
    Route::post('/admin/books', [AdminDashboardController::class, 'storeBook'])->name('admin.books.store');
    Route::get('/admin/borrowings', [AdminDashboardController::class, 'borrowings'])->name('admin.borrowings');
    Route::post('/admin/borrowings/{id}/verify', [AdminDashboardController::class, 'verifyBorrowing'])->name('admin.borrowings.verify');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');
