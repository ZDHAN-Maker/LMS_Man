<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/kelas', function () {
        return view('kelas.index');
    })->name('kelas');

    // API CRUD Kelas
    // API CRUD Kelas, disesuaikan dengan controller
    Route::prefix('api')->group(function () {
        Route::get('kelas', [KelasController::class, 'index']);      // semua login
        Route::get('kelas/{id}', [KelasController::class, 'show']);  // semua login
        Route::post('kelas', [KelasController::class, 'store']);     // hanya admin
        Route::put('kelas/{id}', [KelasController::class, 'update']); // hanya admin
        Route::delete('kelas/{id}', [KelasController::class, 'destroy']); // hanya admin
        
    });
});


require __DIR__.'/auth.php';
