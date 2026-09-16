<?php

use App\Http\Controllers\AssociadoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AssociadoController::class, 'welcome'])->name('welcome');

// Rotas específicas por perfil e tipo de cadastro
Route::get('/adesao/civil', [AssociadoController::class, 'adesaoCivil'])->name('associados.adesao.civil');
Route::get('/atualizacao/civil', [AssociadoController::class, 'atualizacaoCivil'])->name('associados.atualizacao.civil');
Route::get('/adesao/militar', [AssociadoController::class, 'adesaoMilitar'])->name('associados.adesao.militar');
Route::get('/atualizacao/militar', [AssociadoController::class, 'atualizacaoMilitar'])->name('associados.atualizacao.militar');

Route::get('/signup', [AssociadoController::class, 'index'])->name('signup');
Route::post('/signup', [AssociadoController::class, 'store'])->name('signup.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/associados/{associado}/pdf', [AssociadoController::class, 'generatePdf'])->name('associados.pdf');
    Route::get('/admin/associados/{associado}/pdf/ficha', [AssociadoController::class, 'generateFichaPdf'])->name('associados.pdf.ficha');
    Route::get('/admin/associados/{associado}/pdf/contrato', [AssociadoController::class, 'generateContratoPdf'])->name('associados.pdf.contrato');
});

Route::get('/associados/{associado}/pdf/public', [AssociadoController::class, 'generatePdfPublic'])
    ->name('associados.pdf.public')
    ->middleware('signed');
