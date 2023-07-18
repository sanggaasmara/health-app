<?php

use App\Http\Controllers\AlergiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\KonsultasiAlergiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/login", [AuthController::class, "login"]);
// Route::post("/logout", [AuthController::class, "logout"]);

Route::post("/logout", [AuthController::class, "logoutWeb"]);



Route::prefix('gejala')->group(function () {
    Route::get('/', [GejalaController::class, 'index']);
    Route::post('/', [GejalaController::class, 'store']);
    Route::get('/{id}', [GejalaController::class, 'show']);
    Route::put('/{id}', [GejalaController::class, 'update']);
    Route::delete('/{id}', [GejalaController::class, 'destroy']);
});

Route::prefix('alergi')->group(function () {
    Route::get('/', [AlergiController::class, 'index']);
    Route::post('/', [AlergiController::class, 'store']);
    Route::get('/{id}', [AlergiController::class, 'show']);
    Route::put('/{id}', [AlergiController::class, 'update']);
    Route::delete('/{id}', [AlergiController::class, 'destroy']);
});

Route::prefix('konsultasi')->group(function () {
    Route::get('/', [KonsultasiAlergiController::class, 'index']);
    Route::get('/my', [KonsultasiAlergiController::class, 'indexMy'])->middleware("jwt:user");
    Route::get('/guest', [KonsultasiAlergiController::class, 'index']);
    Route::post('/', [KonsultasiAlergiController::class, 'store']);
    Route::get('/{id}/diagnosa', [KonsultasiAlergiController::class, 'analisa']);
    Route::get('/{id}', [KonsultasiAlergiController::class, 'show']);
});
