<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ProgramController as StudentProgramController;
use App\Http\Controllers\Student\MaterialController as StudentMaterialController;
use App\Http\Controllers\Student\ProgressController;
use App\Http\Controllers\Student\NoteController;
use App\Http\Controllers\Student\TestimoniController as StudentTestimoniController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;

use App\Http\Controllers\Guru\AuthController as GuruLoginController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\MaterialController as GuruMaterialController;

use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::middleware('guest:web')->group(function () {
    Route::get('/login-siswa', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login-siswa', [StudentAuthController::class, 'login'])->name('student.login.submit');
    Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('student.register');
    Route::post('/daftar', [RegisterController::class, 'register'])->name('student.register.submit');
});
Route::post('/logout-siswa', [StudentAuthController::class, 'logout'])->name('student.logout');

// Halaman Login Admin
Route::middleware('guest:admin')->group(function () {
    Route::get('admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
});
Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Halaman Login Guru
Route::middleware('guest:guru')->group(function () {
    Route::get('/guru/login', [GuruLoginController::class, 'showLoginForm'])->name('guru.login');
    Route::post('/guru/login', [GuruLoginController::class, 'login'])->name('guru.login.submit');
});

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
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
    Route::put('/admin/enrollments/{id}/update-status', [EnrollmentController::class, 'updateStatus'])->name('enrollments.updateStatus');
    Route::delete('enrollments/{id}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
    Route::get('enrollments/export', [EnrollmentController::class, 'export'])->name('enrollments.export');
    Route::resource('galleries', GalleryController::class);
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('admin.testimoni.index');
    Route::patch('/testimoni/{id}/toggle', [TestimoniController::class, 'toggleStatus'])->name('admin.testimoni.toggle');
    Route::delete('/testimoni/{id}', [TestimoniController::class, 'destroy'])->name('admin.testimoni.destroy');

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard-siswa', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::post('/upload-bukti/{id}', [StudentDashboardController::class, 'uploadBukti'])->name('student.upload.bukti');
    Route::get('/program-saya', [StudentProgramController::class, 'index'])->name('student.program');
    Route::get('/materi-belajar', [StudentMaterialController::class, 'index'])->name('student.material.index');
    Route::get('/materi-belajar/{id}', [StudentMaterialController::class, 'show'])->name('student.material.show');
    Route::post('/materi-belajar/{id}/complete', [StudentMaterialController::class, 'markAsComplete'])->name('student.material.complete');
    Route::get('/progres-belajar', [ProgressController::class, 'index'])->name('student.progress');
    Route::get('/catatan-saya', [NoteController::class, 'index'])->name('student.notes.index');
    Route::post('/catatan-saya', [NoteController::class, 'store'])->name('student.notes.store');
    Route::delete('/catatan-saya/{id}', [NoteController::class, 'destroy'])->name('student.notes.destroy');
    Route::get('/testimoni', [StudentTestimoniController::class, 'index'])->name('student.testimoni.index');
    Route::post('/testimoni', [StudentTestimoniController::class, 'store'])->name('student.testimoni.store');
    Route::get('/profil', [StudentProfileController::class, 'index'])->name('student.profile.index');
    Route::put('/profil/update', [StudentProfileController::class, 'update'])->name('student.profile.update');
    Route::put('/profil/password', [StudentProfileController::class, 'updatePassword'])->name('student.profile.password');
});

Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboardController::class, 'index'])->name('dashboard');
});
