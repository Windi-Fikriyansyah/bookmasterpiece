<?php

use App\Http\Controllers\AksesAplikasiController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripayCallbackController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('/cover-master', function () {
    return view('cover_master');
})->name('cover_master');

Route::get('berlangganan', [LanggananController::class, 'index'])
    ->name('langganan');
Route::get('/checkout/{slug}', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::post('/checkout/process', [CheckoutController::class, 'process'])
    ->name('checkout.process');
Route::post('/checkout/pay', [CheckoutController::class, 'pay'])
    ->name('checkout.pay');

Route::post('/tripay/callback', [TripayCallbackController::class, 'handle'])
    ->name('tripay.callback');

Route::get('/payment/success', [TripayCallbackController::class, 'success'])
    ->name('payment.success');

Route::middleware(['auth', 'subscription.active'])->group(function () {
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


Route::middleware('auth')->group(function () {
    Route::get('akses-aplikasi', [AksesAplikasiController::class, 'aksesAplikasi'])
        ->name('akses.aplikasi');
    Route::get('/grup', [GroupController::class, 'index'])
        ->name('group.index');
    Route::get('/bonus', [BonusController::class, 'index'])
        ->name('bonus.index');

    Route::get('/bonus/{slug}', [BonusController::class, 'view'])
        ->name('bonus.view');
    Route::get('/checkout/renew/{slug}', [CheckoutController::class, 'renew'])
        ->middleware('auth')
        ->name('checkout.renew');

    Route::get('/book-master', function () {
        return view('ebook_master');
    })->name('ebook_master');
});

require __DIR__ . '/auth.php';
