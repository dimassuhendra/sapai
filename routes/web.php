<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

// Halaman Login Admin
Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Menu Akademik (Placeholder #)
    Route::get('/programs', fn() => view('admin.programs.index'))->name('admin.programs');
    Route::get('/materials', fn() => view('admin.materials.index'))->name('admin.materials');
    
    // Menu Konten (Placeholder #)
    Route::get('/settings', fn() => view('admin.settings.index'))->name('admin.settings');
});
