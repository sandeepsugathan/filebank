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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

//users management
Route::group(['prefix' => 'users', 'middleware' => 'is_admin'], function() {
    Route::get('/', ['as' => 'users.index', 'uses' => 'UserController@index']);
    Route::get('add', ['as' => 'users.add', 'uses' => 'UserController@add']);
    Route::get('{user}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::get('{user}/delete', ['as' => 'users.delete', 'uses' => 'UserController@delete']);
    Route::post('update', ['as' => 'users.update', 'uses' => 'UserController@update']);
});