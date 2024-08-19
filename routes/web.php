<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return json_encode(['retorno' => 'ok', 'status' => 200]);
});
