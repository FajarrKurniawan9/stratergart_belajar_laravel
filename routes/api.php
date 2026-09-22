<?php

use App\Http\Controllers\Api\KartuPelajarController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('kelas', KelasController::class);
Route::apiResource('siswa', SiswaController::class);
Route::apiResource('kartu-pelajar', KartuPelajarController::class);
