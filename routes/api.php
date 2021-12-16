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

//Point 1
Route::post('earn_points', 'App\Http\Controllers\OrderbaseController@giveRewards');

//Point 2
Route::get('voidpoints/{orderID}', 'App\Http\Controllers\OrderbaseController@voidRewards');

//Point 3
Route::get('getpoints/{userID}', 'App\Http\Controllers\OrderbaseController@getAllRewards');

//Point 4
Route::get('get__bal__points/{userID}', 'App\Http\Controllers\OrderbaseController@rewardBalance');
