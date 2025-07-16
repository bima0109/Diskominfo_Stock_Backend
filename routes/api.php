<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StockController;

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/

// Endpoint login tanpa autentikasi
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected API Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:api')->group(function () {

    // Mengambil data user yang sedang login
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    //Route untuk Stock Opname
    Route::get('/stock', [StockController::class, 'index']);
    Route::post('/stock', [StockController::class, 'store']);
    Route::get('/stock/{id}', [StockController::class, 'show']);
    Route::put('/stock/{id}', [StockController::class, 'update']);
    Route::delete('/stock/{id}', [StockController::class, 'destroy']);
    // Tambahkan route API lain di sini (misal: /logout, /mobils, dll)
});
