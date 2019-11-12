<?php

// Route::get('categorias', 'CategoryController@index');
// Route::post('categorias', 'CategoryController@store');
// Route::get('categorias/{category}', 'CategoryController@show');
// Route::put('categorias/{category}', 'CategoryController@update');
// Route::delete('categorias/{category}', 'CategoryController@destroy');

Route::apiResource('categorias', 'CategoryController');
