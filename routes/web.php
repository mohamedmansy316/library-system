<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

//Hpmepage
// Route::get('/', 'HomeController@getHome')->name('home');
Route::get('/', [HomeController::class , 'getHome'])->name('home');

/*
    Authentication Routes
    login ,logout , register
    Run php artisan route:list for more details about the routes and endpoints
*/
Auth::routes();

//User / Profile
Route::middleware('auth')->group(function () {
    Route::get('logout', [UserController::class , 'logout'])->name('logout');
    Route::get('profile', [UserController::class , 'getProfile'])->name('profile');
    Route::get('borrow/{id}', [BooksController::class , 'getBookBorrow'])->name('book.borrow');
    Route::get('order/cancel/{id}', [BooksController::class , 'getCancelOrder'])->name('book.borrow.cancel');
    Route::get('order/reverse/{id}', [BooksController::class , 'getReverseBook'])->name('book.borrow.reverse');
});
//Admin & Management System
Route::group(['prefix' => 'admin' , 'middleware' => 'admin'], function(){
    Route::get('/', [AdminController::class , 'getAdmin'])->name('admin.home');
    Route::prefix('books')->group(function(){
    Route::get('/', [AdminController::class , 'getAllBooks'])->name('admin.books.all');
    Route::get('create', [AdminController::class , 'getCreateBook'])->name('admin.books.getCreate');
    Route::post('create', [AdminController::class , 'postCreateBook'])->name('admin.books.postCreate');
    Route::get('edit/{id}', [AdminController::class , 'getEditBook'])->name('admin.books.getEdit');
    Route::post('edit/{id}', [AdminController::class , 'postEditBook'])->name('admin.books.postEdit');
    Route::get('delete/{id}', [AdminController::class , 'deleteBook'])->name('admin.books.delete');
    });
    Route::prefix('borrows')->group(function(){
    Route::get('/', [AdminController::class , 'getBorrowsRequests'])->name('admin.borrows.all');
    Route::get('accept/{id}', [AdminController::class , 'getAcceptBorrow'])->name('admin.request.accept');
    Route::get('refuse/{id}', [AdminController::class , 'getRefuseBorrow'])->name('admin.request.refuse');
    });
    Route::prefix('reverse')->group(function(){
        Route::get('/', [AdminController::class , 'getReverseRequests'])->name('admin.reverse.all');
        Route::get('accept/{id}', [AdminController::class , 'getAcceptReverse'])->name('admin.reverse.accept');
        // Route::get('refuse/{id}', [AdminController::class , 'getRefuseBorrow'])->name('admin.request.refuse');
        });
});
