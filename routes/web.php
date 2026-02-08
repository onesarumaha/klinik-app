<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DataPasienController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\DashboardController;
use App\Models\DataPasien;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->middleware('role:admin')->name('admin.dashboard');

    Route::get('/dokter/dashboard', function () {
        return view('dashboard.dokter');
    })->middleware('role:dokter,doctor')->name('dokter.dashboard');

    // Alias for Doctor
    Route::get('/doctor/dashboard', function () {
        return view('dashboard.dokter');
    })->middleware('role:dokter,doctor')->name('doctor.dashboard');

    Route::get('/perawat/dashboard', function () {
        return view('dashboard.perawat');
    })->middleware('role:perawat')->name('perawat.dashboard');

    Route::get('/kasir/dashboard', function () {
        return view('dashboard.kasir');
    })->middleware('role:kasir')->name('kasir.dashboard');
});

Route::middleware('auth')->group(function () {

    // master datapasien
    Route::resource('data_pasien', DataPasienController::class);

    // master roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    // master data obat
    Route::get('/data-obat', [ObatController::class, 'index'])->name('data-obat');
    Route::post('/data-obat', [ObatController::class, 'store'])->name('data-obat.store');
    Route::get('/data-obat/{id}/edit', [ObatController::class, 'edit'])->name('data-obat.edit');
    Route::put('/data-obat/{id}', [ObatController::class, 'update'])->name('data-obat.update');
    Route::delete('/data-obat/{id}', [ObatController::class, 'destroy'])->name('data-obat.destroy');

    // rekam medis
    Route::resource('rekam_medis', RekamMedisController::class);

});

require __DIR__ . '/auth.php';
