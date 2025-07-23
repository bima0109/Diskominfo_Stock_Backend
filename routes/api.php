<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\PermintaanController;
use App\Http\Controllers\Api\UserController;

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
    // Endpoint untuk logout
    Route::post('/logout', [AuthController::class, 'logout']);


    // Route untuk User
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::post('/users-show', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::put('/users-reset/{id}', [UserController::class, 'resetPassword']);

    //Route untuk Stock Opname
    Route::get('/stock', [StockController::class, 'index']);
    Route::post('/stock', [StockController::class, 'store']);
    Route::get('/stock/{id}', [StockController::class, 'show']);
    Route::put('/stock/{id}', [StockController::class, 'update']);
    Route::delete('/stock/{id}', [StockController::class, 'destroy']);
    Route::post('/stock/search', [StockController::class, 'search']);

    // Route untuk Permintaan
    Route::get('/permintaan', [PermintaanController::class, 'index']);
    Route::post('/permintaan', [PermintaanController::class, 'store']);


    // Tambahkan route API lain di sini (misal: /logout, /mobils, dll)
});
