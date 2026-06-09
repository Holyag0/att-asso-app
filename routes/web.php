<?php

use App\Http\Controllers\AssociadoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AssociadoController::class, 'index'])->name('signup');
Route::post('/signup', [AssociadoController::class, 'store'])->name('signup.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/associados/{associado}/pdf', [AssociadoController::class, 'generatePdf'])->name('associados.pdf');
});

Route::get('/associados/{associado}/pdf/public', [AssociadoController::class, 'generatePdfPublic'])
    ->name('associados.pdf.public')
    ->middleware('signed');
