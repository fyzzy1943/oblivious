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

Route::group(['as' => 'system', 'prefix' => 'system'], function () {
    Route::get('/user', 'UserController@showList');
    Route::get('/user/add', 'UserController@showCreateForm');

    Route::get('category', 'CategoryController@showCategoryList');
    Route::get('category/create', 'CategoryController@showCategoryCreateForm');
    Route::post('category', 'CategoryController@storeCategory');

    Route::resource('rules', 'RuleController');
});

Route::group(['prefix' => 'get'], function () {
    Route::get('image/{img}', 'GetController@getImage');
    Route::get('articles/{serial}/{num?}', 'GetController@getArticles');
    Route::get('title/{title}/{isShadow}', 'GetController@getTitle');
});

Route::group(['prefix' => 'helper'], function () {
    Route::get('regex/list', 'HelperController@showListRegexForm');
    Route::post('regex/list', 'HelperController@testListRegex');
});

Route::get('article/update/{serial?}', 'UpdateController@makeArticle');

Route::get('phpinfo', function () {
    return phpinfo();
});
