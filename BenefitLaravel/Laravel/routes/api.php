<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PGController;

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

Route::get('/pg/request', [PGController::class, 'request'])->name('pg.request');
Route::post('/pg/response', [PGController::class, 'response'])->name('pg.response');
Route::post('/pg/approved', [PGController::class, 'approved'])->name('pg.approved');
Route::post('/pg/declined', [PGController::class, 'declined'])->name('pg.declined');
Route::post('/pg/error', [PGController::class, 'error'])->name('pg.error');
