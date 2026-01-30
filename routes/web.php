<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // master users
    Route::get('/users', [ProfileController::class, 'index'])->name('user.index');
    
    // master patients
    Route::resource('patients', PatientController::class);

    // master data obat 
    Route::get('/data-obat', [ObatController::class, 'index'])->name('data-obat');
});

require __DIR__.'/auth.php';
