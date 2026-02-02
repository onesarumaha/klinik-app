<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DataPasienController;
use App\Models\DataPasien;
use App\Models\Patient;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // master datapasien
    Route::resource('data_pasien', DataPasienController::class);


    // master data obat 
    Route::get('/data-obat', [ObatController::class, 'index'])->name('data-obat');
});

require __DIR__.'/auth.php';
