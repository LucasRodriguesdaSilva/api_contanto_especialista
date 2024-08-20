<?php

use App\Http\Controllers\ContatoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return json_encode(['status' => 200, 'retorno' => 'Ok']);
});

Route::get('/contato', [ContatoController::class, 'index']);
Route::get('/contato/{ticket}', [ContatoController::class, 'detalhar']);

Route::post('/contato', [ContatoController::class, 'criar']);