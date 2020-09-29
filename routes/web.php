<?php

use Illuminate\Support\Facades\Route;


Auth::routes();
Route::get('/','HomeController@index')->name('viewHome');

Route::prefix('/item')->middleware('auth')->group(function(){
    Route::post('/create','ItemController@create')->middleware('admin')->name('createItem');
    Route::get('/show', 'ItemController@show')->name('showItem');
    Route::get('/showData/{id}', 'ItemController@showData')->name('showDataItem');
    Route::get('/edit/{id}','ItemController@edit')->middleware('admin')->name('editItem');
    Route::patch('/update/{id}', 'ItemController@update')->middleware('admin')->name('updateItem');
    Route::get('/delete/{id}', 'ItemController@delete')->middleware('admin')->name('deleteItem');
    Route::post('/addToCart/{id}','ItemController@addToCart')->name('addCart');
    Route::get('/cart','ItemController@showCart')->name('showCart');
    Route::post('/cart/checkout','ItemController@checkout')->name('checkoutItem');
    Route::get('/cart/delete/{id}','ItemController@deleteCartItem')->name('deleteCartItem');
    Route::get('/checkout','ItemController@showCheckout')->name('showCheckout');
    Route::get('/homepage','ItemController@homePage')->name('showHomepage');
});

Route::post('/comment/store', 'CommentController@store' )->name('storeComment');
Route::post('/reply/store', 'CommentController@storeReplies')->name('storeReply');


Route::get('/home', 'HomeController@index')->name('home');


