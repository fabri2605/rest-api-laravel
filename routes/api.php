<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clients', '\App\Http\Controllers\ClientController@index');
Route::post('/clients', '\App\Http\Controllers\ClientController@store');
Route::get('/clients/{client}', '\App\Http\Controllers\ClientController@show');
Route::put('/clients/{client}', '\App\Http\Controllers\ClientController@update');
Route::delete('/clients/{client}', '\App\Http\Controllers\ClientController@destroy');

Route::get('/service', '\App\Http\Controllers\ServiceController@index');
Route::post('/service', '\App\Http\Controllers\ServiceController@store');
Route::get('/service/{service}', '\App\Http\Controllers\ServiceController@show');
Route::put('/service/{service}', '\App\Http\Controllers\ServiceController@update');
Route::delete('/service/{service}', '\App\Http\Controllers\ServiceController@destroy');

Route::post('/client/service/attach', '\App\Http\Controllers\ClientController@attach');
Route::post('/client/service/detach', '\App\Http\Controllers\ClientController@detach');

Route::get('/service/clients/{service}', '\App\Http\Controllers\ServiceController@showClients');
