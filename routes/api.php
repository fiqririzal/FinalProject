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

Require_once('includes/auth.php');
// Require_once('includes/category.php');
// Require_once('includes/article.php');

require_once('includes/category.php');
Route::group( ['middleware' => 'auth:api'], function() {

    Require_once('includes/toko.php');
    Require_once('includes/produk.php');
    Require_once('includes/gabah.php');
    Require_once('includes/pabrik.php');

    Route::middleware('Admin')->group(function(){
        require_once('includes/article.php');
    });
}
);
