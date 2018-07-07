<?php

use Illuminate\Http\Request;

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

// Route::resource('/bot', 'BotController');
Route::post('/bot', 'BotController@index');
Route::get('/distrito', 'BotController@getDistrito');

Route::get('/personal', 'BotController@getDatosPersonales');

// Route::resource('/migrate', 'MigrateController');
