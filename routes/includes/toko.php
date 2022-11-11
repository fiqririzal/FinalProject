<?php

use Illuminate\Support\Facades\Route;

Route::get('/toko','TokoController@index');
Route::get('/toko/{id}','TokoController@show');
Route::post('/toko','TokoController@store');
Route::post('/toko/{id}','TokoController@update');
Route::delete('/toko/{id}','TokoController@destroy');