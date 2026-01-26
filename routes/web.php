<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProgramController as StudentProgramController;


use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/login-siswa', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
Route::post('/login-siswa', [StudentAuthController::class, 'login'])->name('student.login.submit');
Route::post('/logout-siswa', [StudentAuthController::class, 'logout'])->name('student.logout');
Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/daftar', [RegisterController::class, 'register'])->name('student.register.submit');

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
    Route::get('enrollments/export', [EnrollmentController::class, 'export'])->name('enrollments.export');
    Route::resource('galleries', GalleryController::class);

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});

Route::middleware(['auth'])->group(function () {
    // Pastikan URL sesuai dengan yang ada di Sidebar layout sebelumnya
    Route::get('/dashboard-siswa', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/program-saya', [StudentProgramController::class, 'index'])->name('student.program');
});
