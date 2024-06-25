<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermintaanSuratController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');


Route::middleware('auth')->group(function () {
    //sekum 
    Route::get('/showMU', [AdminController::class, 'showMU'])->name('showMU');
    Route::get('/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
    // end
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/suratmasuk', [PagesController::class, 'suratmasuk'])->name('suratmasuk');
    Route::get('/pengirimansurat', [PagesController::class, 'pengirimansurat'])->name('pengirimansurat');
    Route::get('/permintaansurat', [PermintaanSuratController::class, 'permintaansurat'])->name('permintaansurat');
    Route::get('/daftarrequest', [PermintaanSuratController::class, 'daftarrequest'])->name('daftarrequest');
    Route::get('/permintaansurat', [PermintaanSuratController::class, 'permintaansurat'])->name('permintaansurat');
    Route::get('/daftarrequest', [PermintaanSuratController::class, 'daftarrequest'])->name('daftarrequest');
    Route::get('/suratkeluar', [PagesController::class, 'suratkeluar'])->name('suratkeluar');
    Route::get('/profil', [PagesController::class, 'profil'])->name('profil');
    Route::get('/', [PagesController::class, 'index'])->name('index');
    Route::post('/surat', [LetterController::class, 'store'])->name('surat.store');
    Route::get('/statussurat', [PagesController::class, 'statussurat'])->name('statussurat');
    Route::get('/detail/{id}', [LetterController::class, 'detailLetter'])->name('letter.detail');
    Route::get('/approvals', [ApprovalController::class, 'approvals'])->name('approvals');
    Route::post('/approve/{letter_id}', [ApprovalController::class, 'approve'])->name('approve');
    Route::post('/reject/{letter_id}', [ApprovalController::class, 'reject'])->name('reject');
    Route::get('/archive', [LetterController::class, 'archive'])->name('archive');
    Route::post('/permintaansurat/store', [PermintaanSuratController::class, 'store'])->name('permintaansurat.store');
    Route::get('/permintaansekdept', [PermintaanSuratController::class, 'permintaansekdept'])->name('permintaansekdept');
    Route::get('/deleteLetterPermintaan/{id}', [PermintaanSuratController::class, 'deleteLetterPermintaan'])->name('deleteLetterPermintaan');
    Route::get('/deleteLetter/{id}', [LetterController::class, 'deleteLetter'])->name('deleteLetter');
    Route::get('/surat/{id}/edit', [LetterController::class, 'edit'])->name('editLetter');
    Route::put('/surat/{id}', [LetterController::class, 'update'])->name('updateLetter');
    Route::put('/surat/{id}', [LetterController::class, 'update'])->name('surat.update');
    Route::get('/editLetter/{id}', [LetterController::class, 'edit'])->name('editLetter');

});

require __DIR__.'/auth.php';