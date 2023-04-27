<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\FarmacoController;
use App\Models\farmaco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\FarmacoController as FarmacoV1;

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


Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);

Route::apiResource('v1/farmacos', FarmacoV1::class)
      ->only(['index','show', 'destroy'])
      ->middleware('auth:sanctum');

Route::post('consulta', [App\Http\Controllers\Api\LoginController::class, 'query']);
