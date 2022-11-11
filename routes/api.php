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
Require_once('includes/category.php');
Require_once('includes/article.php');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
