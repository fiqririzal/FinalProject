<?php

use Illuminate\Support\Facades\Route;

Route::get('/toko','TokoController@index');
Route::get('/toko/{id}','TokoController@show');
Route::get('/tokoWith/{id}','TokoController@showWith');
Route::post('/toko','TokoController@store');
Route::post('/toko/{id}','TokoController@update');
Route::delete('/toko/{id}','TokoController@destroy');