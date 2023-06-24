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

Route::group(['middleware' => 'auth:sanctum'], function(Request $request) {
    Route::get('transaction/list', 'App\Http\Controller\TransactionController@list');
    Route::post('transaction/create', 'App\Http\Controller\TransactionController@store');
    Route::post('transaction/update', 'App\Http\Controller\TransactionController@update');
    Route::post('transaction/reject', 'App\Http\Controller\TransactionController@rejectTransaction');
    Route::get('transaction/find/{id}', 'App\Http\Controller\TransactionController@get');
    Route::get('transaction/find/otp/{otp}', 'App\Http\Controller\TransactionController@findUsingOTP');
    Route::get('transaction/approve/{id}', 'App\Http\Controller\TransactionController@approveTransaction');

});
