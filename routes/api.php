<?php

use App\Http\Controllers\ContatoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return json_encode(['status' => 200, 'retorno' => 'Ok']);
});

Route::post('contato', [ContatoController::class, 'criar']);