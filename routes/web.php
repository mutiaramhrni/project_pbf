<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/suratmasuk', [PagesController::class, 'suratmasuk'])->name('suratmasuk');
    Route::get('/pengirimansurat', [PagesController::class, 'pengirimansurat'])->name('pengirimansurat');
    Route::get('/permintaansurat', [PagesController::class, 'permintaansurat'])->name('permintaansurat');
    Route::get('/suratkeluar', [PagesController::class, 'suratkeluar'])->name('suratkeluar');
    Route::get('/profil', [PagesController::class, 'profil'])->name('profil');
    Route::get('/', [PagesController::class, 'index'])->name('index');
    Route::post('/surat', [PagesController::class, 'store'])->name('surat.store');
});

require __DIR__.'/auth.php';
