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



Route::get('/', 'PagesController@index')->name('dashboard');


Route::get('/product/{id}', 'PagesController@productSelected')
    ->where('id', '[0-9]+')
    ->name('product');

Auth::routes();

Route::resource('admin', 'AdminController');

Route::get('/change-visibility/{id}', 'AdminController@changeVisibility')
    ->where('id', '[0-9]+')
    ->middleware('auth')
    ->name('changeVisibility');
