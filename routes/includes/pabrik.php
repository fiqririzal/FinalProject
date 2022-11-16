<?php

use Illuminate\Support\Facades\Route;

Route::get('/pabrik/{id}','PabrikController@show');
Route::get('/pabrikWith/{id}','PabrikController@showWith');
Route::post('/pabrik','PabrikController@store');
Route::post('/pabrik/{id}','PabrikController@update');
Route::delete('/pabrik/{id}','PabrikController@destroy');
