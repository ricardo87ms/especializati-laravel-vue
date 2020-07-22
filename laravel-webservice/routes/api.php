<?php

// Route::get('categorias', 'CategoryController@index');
// Route::post('categorias', 'CategoryController@store');
// Route::get('categorias/{category}', 'CategoryController@show');
// Route::put('categorias/{category}', 'CategoryController@update');
// Route::delete('categorias/{category}', 'CategoryController@destroy');

Route::post('auth', 'Auth\AuthApiController@authenticate');
Route::post('auth-refresh', 'Auth\AuthApiController@refreshToken');
Route::get('me', 'Auth\AuthApiController@getAuthenticatedUser');

Route::prefix('v1')->namespace('Api\v1')->middleware('auth:api')->group(function () {
    Route::get('/categorias/{categoria}/produtos', 'CategoryController@produtos');
    Route::apiResource('categorias', 'CategoryController');
    Route::apiResource('produtos', 'ProductController');
});
