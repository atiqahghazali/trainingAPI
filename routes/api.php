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

Route::get('/basic-auth', function () {
    return 'Successfully access basic authentication API';
})->middleware('auth.basic');

Route::post('/login','App\Http\Controllers\API\AuthController@login');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pivacy-policy','App\Http\Controllers\API\PrivacyPolicyController@show');

Route::prefix('v1')->middleware('auth:api')->group(function(){
    Route::get('/houses','App\Http\Controllers\API\HouseController@index');
    Route::post('/houses/create','App\Http\Controllers\API\HouseController@store');
    Route::get('/houses/edit/{house}','App\Http\Controllers\API\HouseController@show');
    Route::post('/houses/update/{house}','App\Http\Controllers\API\HouseController@update');
    Route::delete('/houses/delete/{house}','App\Http\Controllers\API\HouseController@delete');

    Route::get('/users','App\Http\Controllers\API\UserController@index');
    Route::post('/users/create','App\Http\Controllers\API\UserController@store');
    Route::get('/users/{user}','App\Http\Controllers\API\UserController@show');
    Route::post('/users/update/{user}','App\Http\Controllers\API\UserController@update')->name('update');
    Route::delete('/users/delete/{user}','App\Http\Controllers\API\UserController@delete');
});





