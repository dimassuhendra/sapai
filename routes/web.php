<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\MaterialController;
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
    Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
    Route::post('/programs', [ProgramController::class, 'store'])->name('programs.store');
    Route::put('/programs/{program}', [ProgramController::class, 'update'])->name('programs.update');
    Route::delete('/programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy');
    Route::get('admin/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::post('admin/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::put('admin/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('admin/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
    Route::get('/materials', fn() => view('admin.materials.index'))->name('admin.materials');

    // Menu Konten (Placeholder #)
    Route::get('/settings', fn() => view('admin.settings.index'))->name('admin.settings');
});
