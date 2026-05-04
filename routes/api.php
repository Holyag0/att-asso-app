<?php

use App\Http\Controllers\AssociadoController;
use Illuminate\Support\Facades\Route;

Route::post('/associados', [AssociadoController::class, 'apiStore']);
