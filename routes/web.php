<?php

use Illuminate\Support\Facades\Route;



Route::get('/','HomeController@index')->name('viewHome');
Route::post('/item/create','ItemController@create')->name('createItem');
Route::get('/item/show', 'ItemController@show')->name('showItem');
Route::get('/item/showData/{id}', 'ItemController@showData')->name('showDataItem');
Route::get('/item/edit/{id}','ItemController@edit')->name('editItem');
Route::patch('/item/update/{id}', 'ItemController@update')->name('updateItem');
Route::get('/item/delete/{id}', 'ItemController@delete')->name('deleteItem');
Route::get('/item/addToCart/{id}','ItemController@addToCart')->name('addCart');
Route::get('/item/cart','ItemController@showCart')->name('showCart');
Route::get('/item/checkout','ItemController@checkout')->name('checkoutItem');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/clear-cache', function() {
// 	$exitCode = Artisan::call('cache:clear');
// 	$exitCode = Artisan::call('view:clear');
// 	$exitCode = Artisan::call('route:clear');
// 	$exitCode = Artisan::call('config:clear');
// 	return 'Cache has been cleared!';
// });
