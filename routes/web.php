<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AssociadoController;

Route::get('/', [AssociadoController::class, 'index'])->name('signup');
Route::post('/signup', [AssociadoController::class, 'store'])->name('signup.store');
