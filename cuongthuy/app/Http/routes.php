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

Route::get('index','Frontend\TopController@getIndex');
Route::get('list/{id}/{page?}','Frontend\ProductController@getIndex');
Route::get('cart', 'Frontend\CartController@getIndex');