<?php

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

Route::get('/team', "\App\Http\Controllers\TeamController@index");
Route::get('/team/{team_id}', "\App\Http\Controllers\TeamController@read");
Route::post('/team', "\App\Http\Controllers\TeamController@create");
Route::put('/team/{team_id}', "\App\Http\Controllers\TeamController@update");
Route::delete('/team/{team_id}', "\App\Http\Controllers\TeamController@delete");
