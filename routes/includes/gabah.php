<?php

use Illuminate\Support\Facades\Route;

Route::get('/gabah','GabahController@index');
Route::get('/gabah/{id}','GabahController@show');
Route::post('/gabah','GabahController@store');
Route::post('/gabah/{id}','GabahController@update');
Route::delete('/gabah/{id}','GabahController@destroy');