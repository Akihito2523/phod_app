<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PhodController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//API用のルーティング
Route::apiResource('phods', PhodController::class)
    ->middleware('auth:api')
    ->names('api.phods');

Route::apiResource('phods.list', PhodController::class)
    ->middleware('auth:api')
    ->names('api.phods.list');



//table.blade.php
// Route::get('phods/table/', [PhodController::class, 'table'])
//     ->name('table');
