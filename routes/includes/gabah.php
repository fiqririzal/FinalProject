<?php

use Illuminate\Support\Facades\Route;

Route::post('/gabah','GabahController@store');
Route::post('/gabah/{id}','GabahController@update');
Route::delete('/gabah/{id}','GabahController@destroy');
