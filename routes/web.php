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

Route::get('/duy', function () {
    return view('duy');
});
Route::get('/', function () {
    return view('welcome');
});
//Route::get('/home', 'PagesController@actionIndex');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/home', 'PagesController@index');
Route::get('/view/{id}', 'PagesController@view');
Route::get('/create', 'PagesController@create');
//Route::get('/home', 'HomeController@index')->name('home');

Route::resource('articles', 'ArticleController');