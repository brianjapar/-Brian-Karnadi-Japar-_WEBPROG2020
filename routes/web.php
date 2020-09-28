<?php

use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/','HomeController@index')->name('viewHome');

Route::prefix('/item')->middleware('auth')->group(function(){
    Route::post('/create','ItemController@create')->name('createItem');
    Route::get('/show', 'ItemController@show')->name('showItem');
    Route::get('/showData/{id}', 'ItemController@showData')->name('showDataItem');
    Route::get('/edit/{id}','ItemController@edit')->name('editItem');
    Route::patch('/update/{id}', 'ItemController@update')->name('updateItem');
    Route::get('/delete/{id}', 'ItemController@delete')->name('deleteItem');
    Route::post('/addToCart/{id}','ItemController@addToCart')->name('addCart');
    Route::get('/cart','ItemController@showCart')->name('showCart');
    Route::post('/cart/checkout','ItemController@checkout')->name('checkoutItem');
    Route::get('/cart/delete/{id}','ItemController@deleteCartItem')->name('deleteCartItem');
    Route::get('/checkout','ItemController@showCheckout')->name('showCheckout');
});




Route::get('/home', 'HomeController@index')->name('home');


