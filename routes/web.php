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


Route::get('/product/{id}', 'PagesController@productSelected')->name('product');

Auth::routes();

//Route::get('/admin', 'AdminController@index')->name('admin');
//Route::delete('/admin/delete/{id}', 'AdminController@destroy')->name('delete');
//Route::put('/admin/edit/{id}', 'AdminController@update')->name('edit');

Route::resource('admin', 'AdminController');
