<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibliografiaController;
use App\Http\Controllers\FarmacoController;
use App\Http\Controllers\GrupofarmacoController;
use App\Http\Controllers\InteraccionesController;
use App\Models\farmaco;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/', [FarmacoController::class, 'index']);

Route::controller(GrupofarmacoController::class)->group(function(){
    Route::get('grupofarmacos', 'index');
    Route::get('grupofarmacos/create', 'create');
    Route::get('grupofarmacos/create2/{grupofarmaco}', 'create2');
    Route::post('grupofarmacos/create', 'store');
    Route::delete('grupofarmacos/{grupofarmaco}', 'destroy');
 });
Route::controller(FarmacoController::class)->group(function(){
   Route::get('farmacos', 'index');
   Route::get('farmacos/create', 'create');
   Route::get('farmacoss/{farmaco}', 'create2');
   Route::post('farmacos/create', 'store');
   Route::post('farmacos/create2', 'store2');
  // Route::get('farmacos/{farmaco}', 'show');
   //Route::get('farmacos/{farmaco}/edit', 'edit');
   Route::put('farmacos/{farmaco}', 'update');
   Route::delete('farmacos/{farmaco}', 'destroy');
   Route::put('farmacosss/{farmaco}', 'store3');
   Route::put('farmacosact/{farmaco}', 'active');

});

Route::controller(InteraccionesController::class)->group(function(){
    Route::get('interacciones', 'index');
    Route::post('interacciones/create', 'store');
    Route::get('interacciones/{interacciones}', 'show');
    Route::get('interacciones/{interacciones}/edit', 'edit');
    Route::put('interacciones/{interacciones}', 'store3');
    Route::delete('interacciones/{interacciones}', 'destroy');

 });

Route::controller(BibliografiaController::class)->group(function(){
    Route::get('bibliografias', 'index');
    Route::get('bibliografias/create', 'create');
    Route::get('bibliografias/create2/{bibliografia}', 'create2');
    Route::post('bibliografias/create', 'store');
    Route::delete('bibliografias/{bibliografia}', 'destroy');
 });

 
