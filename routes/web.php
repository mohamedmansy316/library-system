<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/', 'HomeController@getHome')->name('home');

Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('logout' , 'UserController@logout')->name('logout');
    Route::get('profile' , 'UserController@getProfile')->name('profile');
    Route::get('borrow/{id}' , 'BooksController@getBookBorrow')->name('book.borrow');
    Route::get('orders' , 'UserController@getOrders')->name('orders');
    Route::get('order/cancel/{id}' , 'BooksController@getCancelOrder')->name('book.borrow.cancel');
});
Route::group(['prefix' => 'admin' , 'middleware' => 'admin'], function(){
    Route::get('/' , 'UserController@getAdmin')->name('admin.home');
    Route::prefix('books')->group(function(){
        Route::get('/' , 'BooksController@getAdminAll')->name('admin.books.all');
        Route::get('create' ,'BooksController@getCreateBook')->name('admin.books.getCreate');
        Route::post('create' ,'BooksController@postCreateBook')->name('admin.books.postCreate');
        Route::get('edit/{id}' , 'BooksController@getEditBook')->name('admin.books.getEdit');
        Route::post('edit/{id}' , 'BooksController@postEditBook')->name('admin.books.postEdit');
        Route::get('delete/{id}' , 'BooksController@deleteBook')->name('admin.books.delete');
    });
    Route::prefix('borrows')->group(function(){
        Route::get('/' , 'BooksController@getBorrowsRequests')->name('admin.borrows.all');
        Route::get('accept/{id}' , 'BooksController@getAcceptRequest')->name('admin.request.accept');
        Route::get('refuse/{id}' , 'BooksController@getRefuseRequest')->name('admin.request.refuse');
        // Route::post('edit/{id}' , 'BooksController@postEditBook')->name('admin.borrows.postEdit');
        // Route::get('delete/{id}' , 'BooksController@deleteBook')->name('admin.borrows.delete');
    });
});
