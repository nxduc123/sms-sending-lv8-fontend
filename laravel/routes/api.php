<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUpdateStatus;
use App\Http\Middleware\APIFPTKey;
use App\Http\Controllers\ApiUpdateStatusZalo;
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
//Route::any('/dlr', ['uses' => 'ApiUpdateStatus@receiveMo', 'as' => 'dlr'])->middleware('APIFPTKey');

Route::middleware(['APIFPTKey'])->group(function () {
    Route::any('/dlr', [ApiUpdateStatus::class, 'receiveMo']);
});
Route::middleware(['APIFPTKey'])->group(function () {
    Route::any('/zalodlr', [ApiUpdateStatusZalo::class, 'receiveZALO']);
});
