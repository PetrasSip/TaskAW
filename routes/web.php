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

Route::post('add-specification/{id}', 'AdminController@addSpecification')
    ->where('id', '[0-9]+')
    ->middleware('auth')
    ->name('addSpecification');

Route::get('remove-specification/{pid}/{sid}', 'AdminController@removeSpecification')
    ->where('pid', '[0-9]+')
    ->where('sid', '[0-9]+')
    ->middleware('auth')
    ->name('removeSpecification');

Route::post('new-specification', 'AdminController@addNewSpecification')
    ->middleware('auth')
    ->name('addNewSpecification');

Route::get('/change-visibility/{id}', 'AdminController@changeVisibility')
    ->where('id', '[0-9]+')
    ->middleware('auth')
    ->name('changeVisibility');
