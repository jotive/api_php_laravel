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

// Login / iniciar sesión / obtener token
Route::post('login', 'UserController@login');
Route::ApiResource('users', 'UserController');

Route::group(['middleware' => 'auth:api'], function (){
    Route::post('logout', 'UserController@logout');
});


Route::fallback('UserController@any');