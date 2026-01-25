<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\RegistrationController;

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
    // Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    // Route::put('registrations/{id}/update-status', [RegistrationController::class, 'updateStatus'])->name('registrations.updateStatus');
    // Route::delete('registrations/{id}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');
    Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::put('enrollments/{id}/update-status', [EnrollmentController::class, 'updateStatus'])->name('enrollments.updateStatus');
    Route::delete('enrollments/{id}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');

    });
