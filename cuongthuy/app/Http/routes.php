<?php
Route::get('linh_test', 'TestController@getIndex');
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
Route::get('/','Frontend\TopController@getIndex');
Route::get('list','Frontend\ProductController@getIndex');
Route::get('cart', 'Frontend\CartController@getIndex');
Route::any('login/{provider?}','Frontend\LoginController@login');
Route::post('recover_pass','Frontend\LoginController@recoverPass');
Route::post('register','Frontend\RegisterController@register');
Route::post('logout','Frontend\LoginController@logout');
Route::post('updateCart', 'Frontend\CartController@updateCart');
Route::post('deleteCart', 'Frontend\CartController@deleteCart');
Route::any('addCart', 'Frontend\CartController@addCart');
Route::controller('checkout', 'Frontend\CheckoutController');
Route::get('detail', 'Frontend\DetailController@getIndex');
Route::any('contact', 'Frontend\ContactController@getContact');
Route::get('about',function(){
    return view('Frontend/about');
});
Route::get('shopping_guide',function(){
    return view('Frontend/shopping_guide');
});
Route::get('rule_change_pay',function(){
    return view('Frontend/rule_change_pay');
});
Route::any('updateRating', 'Frontend\RatingController@updateRating');

Route::any('admin/', 'Admin\LoginController@login');
Route::get('admin//logout', 'Admin\LoginController@logout');
Route::group(array('prefix'=>'admin','middleware' => 'checkLogin'),function(){
    Route::get('/top','Admin\TopController@index');
    Route::get('/product/index', 'Admin\ProductController@index');
    Route::any('/product/detail/{id?}', 'Admin\ProductController@detail');
    Route::any('/product/search', 'Admin\ProductController@search');
    Route::get('/category/index', 'Admin\CategoryController@getParentList');
    Route::post('/category/api', 'Admin\CategoryController@procAjax');
    Route::controller('order', 'Admin\OrderController');
    Route::get('/order/search',  ['uses' => 'OrderController@getSearch']);
    Route::post('/order/search',  ['uses' => 'OrderController@postSearch']);
    Route::controller('order_detail', 'Admin\OrderDetailController');
    Route::any('/maintenance','Admin\MaintenanceController@index');
});