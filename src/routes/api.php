<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('crypto')->group(function () {
    Route::get('/', [CryptoController::class, 'show']);
});
