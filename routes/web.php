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
Route::get('home', 'HomeController@index');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::resource('rules', 'RuleController');

Route::resource('articles', 'ArticleController');
Route::get('articles/serial/{serial}', 'ArticleController@index');
Route::get('articles-under-review', 'ArticleController@reviewIndex');
Route::get('articles/{article}/review', 'ArticleController@reviewForm');
Route::put('articles/{article}/review', 'ArticleController@review');

Route::get('update/{serial?}', 'UpdateController@update');

Route::group(['as' => 'system', 'prefix' => 'system'], function () {
    Route::get('users', 'UserController@index');
    Route::get('users/create', 'UserController@create');
    Route::post('users', 'UserController@store');
    Route::delete('users/{user}', 'UserController@destroy');

//    Route::get('category', 'CategoryController@showCategoryList');
//    Route::get('category/create', 'CategoryController@showCategoryCreateForm');
//    Route::post('category', 'CategoryController@store');
//    Route::get('category/{id}/edit', 'CategoryController@edit');
//    Route::put('category/{id}', 'CategoryController@update');
});

Route::group(['prefix' => 'get'], function () {
    Route::get('image/{img}', 'GetController@getImage');
    Route::get('articles/{serial}/{num?}', 'GetController@getArticles');
    Route::get('title/{title}/{isShadow}', 'GetController@getTitle');
});

Route::group(['prefix' => 'regex'], function () {
    Route::get('list', 'HelperController@showListRegexForm');
    Route::get('article', 'HelperController@showArticleRegexForm');
    Route::post('article/area_test', 'HelperController@articleAreaTest');
    Route::post('article/title_test', 'HelperController@articleTitleTest');
    Route::post('article/date_test', 'HelperController@articleDateTest');
    Route::post('article/text_test', 'HelperController@articleTextTest');
    Route::post('list/area_test', 'HelperController@listAreaTest');
    Route::post('list/list_test', 'HelperController@listListTest');
});


Route::get('phpinfo/{st}', function ($st) {
    dd(str_plural($st));
    dd(url('system/users'));
    return phpinfo();
});


