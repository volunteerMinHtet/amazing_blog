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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin/index');
});

// Route::get('/admin/country', 'Admin\Country');

Route::group(['prefix' => 'admin'], function () {

    Route::resource('authors', 'Admin\AuthorController');
    Route::resource('countries', 'Admin\CountryController');
    Route::resource('posts', 'Admin\PostController');
});

Route::get('master',function(){
    return view('admin.layout.master');
});

Route::group(['prefix' => 'blog'], function () {
    Route::get('index', 'PostController@index');
    Route::get('searchByCountry/{id}', 'PostController@searchByCountry');
});

