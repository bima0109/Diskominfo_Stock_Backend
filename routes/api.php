<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\PermintaanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerifikasiController;
use App\Http\Controllers\Api\HistoryStockController;
use App\Http\Controllers\Api\BarangHabisController;
use App\Http\Controllers\Api\CartController;

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
    Route::get('/profile', [UserController::class, 'getProfile']);
    Route::put('/reset', [UserController::class, 'updatePassword']);
    Route::put('/profile', [UserController::class, 'updateProfile']);

    //Route untuk Stock Opname
    Route::get('/stock', [StockController::class, 'index']);
    Route::post('/stock', [StockController::class, 'store']);
    Route::get('/stock/{id}', [StockController::class, 'show']);
    Route::put('/stock/{id}', [StockController::class, 'update']);
    Route::delete('/stock/{id}', [StockController::class, 'destroy']);
    Route::post('/stock/search', [StockController::class, 'search']);


    // Route untuk Verifikasi
    Route::get('/verifikasi', [VerifikasiController::class, 'index']);
    Route::post('/verifikasi', [VerifikasiController::class, 'store']);
    Route::get('/veribid', [VerifikasiController::class, 'getByBidang']);
    Route::post('/rekap-tahunan', [VerifikasiController::class, 'getRekapTahunan']);
    Route::put('/verif-kabid/{id}', [VerifikasiController::class, 'setVerifKabid']);
    Route::get('/verif-kabid', [VerifikasiController::class, 'diproses']);
    Route::put('/verif-sekre/{id}', [VerifikasiController::class, 'setVerifSekre']);
    Route::get('/verif-sekre', [VerifikasiController::class, 'accKabid']);
    Route::put('/verif-pptk/{id}', [VerifikasiController::class, 'setVerifPptk']);
    Route::get('/verif-pptk', [VerifikasiController::class, 'accSekre']);

    // Route untuk Permintaan
    Route::put('/permintaan/{id}', [PermintaanController::class, 'update']);
    Route::delete('/permintaan/{id}', [PermintaanController::class, 'destroy']);

    // Route untuk Data Rekap
    Route::get('/masuk', [HistoryStockController::class, 'index']);
    Route::get('/masih', [BarangHabisController::class, 'indexMasih']);
    Route::get('/habis', [BarangHabisController::class, 'indexHabis']);
    // Route::post('/masih', [StockController::class, 'Masih']);
    // Route::post('/habis', [StockController::class, 'Habis']);
    // Route::put('/masih/{id}', [BarangHabisController::class, 'updateTanggalMasih']);
    // Route::put('/habis/{id}', [BarangHabisController::class, 'updateTanggalHabis']);
    // Route::put('/masuk/{id}', [HistoryStockController::class, 'updateTanggal']);


    //Route untuk cart
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::put('/cart/{id}', [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
});
