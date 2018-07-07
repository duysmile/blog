<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/signup', 'User\SignupController@index')->name('signup');
Route::post('/signup/verify', 'User\SignupController@store')->name('verify');
Route::get('/signup/verify/{token}', 'User\SignupController@verifyUser');

Route::prefix('admin')->group(function (){
    Route::get('/', 'Admin\SigninController@index')->name('signin');
    Route::post('/login', 'Admin\SigninController@login')->name('login');
    Route::get('/home', 'Admin\HomeController@index')->name('admin');
    Route::get('/logout', 'Admin\HomeController@logout')->name('logout');
    Route::get('/articles/search', 'Admin\ArticleController@search')->name('articles.search');
    Route::resource('articles', 'Admin\ArticleController');
    Route::match(['put', 'patch'], 'articles.update_status', 'Admin\ArticleController@updateStatus')->name('articles.updateStatus');
    Route::match(['put', 'patch'], 'articles.update_top', 'Admin\ArticleController@updateTop')->name('articles.updateTop');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('users', 'Admin\UserController');
});

Route::prefix('')->group(function(){
    Route::get('/', 'User\HomeController@index')->name('home');
    Route::get('/blog_archie', 'User\ListArticleController@getByTime')->name('time');
    Route::get('/search', 'User\ListArticleController@search')->name('search');
    Route::get('/{category}/{article}', 'User\ArticleController@index')->name('content');
    Route::get('/{category}', 'User\ListArticleController@index')->name('list');
});
