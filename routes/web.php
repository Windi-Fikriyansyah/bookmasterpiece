<?php

use App\Http\Controllers\AksesAplikasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('akses-aplikasi', [AksesAplikasiController::class, 'aksesAplikasi'])
        ->name('akses.aplikasi');

    Route::get('book-masterpiece', [AksesAplikasiController::class, 'bookMasterpiece'])
        ->name('bookmasterpiece.index');

    Route::post('/save-api-key', [AksesAplikasiController::class, 'saveApiKey'])
        ->name('save.apikey');
    Route::get('/get-api-key', [AksesAplikasiController::class, 'getApiKey'])
        ->name('get.apikey');

    Route::post('/ebook/generate', [AksesAplikasiController::class, 'generateEbookPart'])
        ->name('ebook.generate');
    Route::post('/ebook/download', [AksesAplikasiController::class, 'downloadPDF']);
});

require __DIR__ . '/auth.php';
