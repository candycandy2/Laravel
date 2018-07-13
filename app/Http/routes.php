<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});

//Route 路由
Route::get('movie', function () {
    return '電影列表!1';
});
//Add controller  App\Http\Controllers
Route::get('movie/{id}', 'MovieController@showMovie');