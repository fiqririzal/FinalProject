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

require_once('includes/category.php');
Require_once('includes/auth.php');
require_once('includes/article.php');

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
    });
}
);
