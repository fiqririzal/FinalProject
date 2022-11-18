<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// show all pabrik
Route::get('/pabrik','PabrikController@index');

Route::get('/produk/{id}','ProdukController@show');
// show all gabah
Route::get('/gabah','GabahController@index');
// show gabah berdasar id
Route::get('/gabah/{id}','GabahController@show');
//show all toko
Route::get('/toko','TokoController@index');
//show all produk
Route::get('/produk','ProdukController@index');
//show all category
Route::get('/category', 'CategoryController@index');
//article by id category
Route::get('/category/{id}', 'CategoryController@show');
//show all article
Route::get('/article','ArticleController@index');
//article berdasar id
Route::get('/article/{id}','ArticleController@show');


Require_once('includes/auth.php');

Route::group( ['middleware' => 'auth:api'], function() {
    Route::middleware('role:Pabrik|Admin')->group(function() {
        Require_once('includes/pabrik.php');
        Require_once('includes/gabah.php');
    });
    Route::middleware('role:Toko|Admin')->group(function() {
        Require_once('includes/toko.php');
        Require_once('includes/produk.php');

    });
    Route::middleware('role:Admin')->group(function(){
        require_once('includes/category.php');
        require_once('includes/article.php');
    });
}
);
