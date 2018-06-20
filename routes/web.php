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


Route::get('/', 'User\HomeController@index')->name('home');
//Route::get('/home', 'PagesController@actionIndex');
//Route::view('/about', 'about');
//Route::view('/contact', 'contact');
//
//Route::get('/home', 'PagesController@index');
//Route::get('/view/{id}', 'PagesController@view');
//Route::get('/create', 'PagesController@create');


Route::get('/signup', 'User\SignupController@index')->name('signup');
Route::post('/signup/verify', 'User\SignupController@store')->name('verify');

Route::get('/signup/verify/{token}', 'User\SignupController@verifyUser');

Route::prefix('admin')->group(function (){
    Route::get('/', 'Admin\SigninController@index')->name('signin');
    Route::post('/login', 'Admin\SigninController@login')->name('login');
    Route::get('/home', 'Admin\HomeController@index')->name('admin');
    Route::get('/logout', 'Admin\HomeController@logout')->name('logout');
    Route::resource('articles', 'Admin\ArticleController');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('users', 'Admin\UserController');
});

//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//    Lfm::routes();
//});