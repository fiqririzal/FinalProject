<?php

use Illuminate\Support\Facades\Route;


// Route::get('/category/{id}', 'CategoryController@show');
Route::post('/category', 'CategoryController@store');
Route::post('/category/{id}', 'CategoryController@update');
Route::delete('/category/{id}', 'CategoryController@destroy');
