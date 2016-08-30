<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');

Route::get('/user', 'UserController@showList');
Route::get('/user/add', 'UserController@showCreateForm');

Route::get('/category', 'CategoryController@showCategoryList');
Route::get('/category/create', 'CategoryController@showCategoryCreateForm');
Route::post('/category', 'CategoryController@storeCategory');

Route::resource('/update', 'UpdateController');
