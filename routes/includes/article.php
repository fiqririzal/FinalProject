<?php

use Illuminate\Support\Facades\Route;


Route::post('/article','ArticleController@store');
Route::get('/article','ArticleController@index');
Route::delete('/article/{id}','ArticleController@destroy');
Route::post('/article/{id}','ArticleController@update');
