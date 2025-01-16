<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CargaBancoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('carga_banco', [CargaBancoController::class, 'getPokemonsPrimeiraGeracao']);
