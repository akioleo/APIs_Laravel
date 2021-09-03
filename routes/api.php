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

//PRODUCT ROUTE
//Route::get('/products', 'Api\\ProductController@index');
Route::namespace('Api')->prefix('products')->group(function(){
    Route::get('/', 'ProductController@index');
    Route::post('/', 'ProductController@save');
});