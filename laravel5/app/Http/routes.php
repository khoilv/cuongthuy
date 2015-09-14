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
Route::get("job/{page?}",array("as"=>"index","uses"=>"Job\JobController@index"));
Route::get("job/show/{id}",array("as"=>"show","uses"=>"Job\JobController@show"));
Route::any("job/edit/{id}",array("as"=>"edit","uses"=>"Job\JobController@edit"));
Route::any("job/create/job",array("as"=>"create","uses"=>"Job\JobController@create"));
