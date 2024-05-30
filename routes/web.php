<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/suratmasuk', [PagesController::class, 'suratmasuk'])->name('suratmasuk');
    Route::post('/craete', [PagesController::class, 'create'])->name('create');
    Route::get('/createincoming', [PagesController::class, 'createincoming'])->name('createincoming');
    Route::get('/suratkeluar', [PagesController::class, 'suratkeluar'])->name('suratkeluar');
    Route::get('/profil', [PagesController::class, 'profil'])->name('profil');
    Route::get('/', [PagesController::class, 'index'])->name('index');
});

require __DIR__.'/auth.php';
