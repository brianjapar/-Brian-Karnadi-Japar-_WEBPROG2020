<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@index')->name('viewHome');
Route::post('/item/create','ItemController@create')->name('createItem');
Route::get('/item/edit/{id}','ItemController@edit');
Route::get('/item/show', 'ItemController@show')->name('showItem');
Route::get('item/showData/{id}', 'ItemController@showData')->name('showDataItem');
Route::get('item/edit/{id}','ItemController@edit')->name('editItem');
Route::patch('item/update/{id}', 'ItemController@update')->name('updateItem');
Route::get('item/delete/{id}', 'ItemController@delete')->name('deleteItem');

