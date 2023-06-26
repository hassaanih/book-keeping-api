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

Route::post('user/signin', 'App\Http\Controllers\UserController@signin');
Route::get('user/signout', 'App\Http\Controllers\UserController@signout');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('transaction/list', 'App\Http\Controllers\TransactionController@list');
    Route::post('transaction/create', 'App\Http\Controllers\TransactionController@store');
    Route::post('transaction/update', 'App\Http\Controllers\TransactionController@update');
    Route::post('transaction/reject', 'App\Http\Controllers\TransactionController@rejectTransaction');
    Route::get('transaction/find/{id}', 'App\Http\Controllers\TransactionController@get');
    Route::get('transaction/find/otp/{otp}', 'App\Http\Controllers\TransactionController@findUsingOTP');
    Route::get('transaction/approve/{id}', 'App\Http\Controllers\TransactionController@approveTransaction');

});
