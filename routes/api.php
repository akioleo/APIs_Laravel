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
Route::namespace('Api')->group(function(){
    Route::prefix('products')->group(function(){
        Route::get('/', 'ProductController@index');
        Route::get('/{id}', 'ProductController@show');
        Route::post('/', 'ProductController@save');//->middleware('auth.basic');
        Route::put('/', 'ProductController@update');
        Route::patch('/', 'ProductController@update');
        Route::delete('/{id}', 'ProductController@delete');
    });

    Route::resource('/users', 'UserController');

});
