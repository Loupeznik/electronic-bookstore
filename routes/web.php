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

Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'FrontEndController@booksFeature');
    Route::get('/books', 'FrontEndController@booksPage');
    Route::get('/books/detail/{id}', 'FrontEndController@bookDetail');
    Route::get('/authors/detail/{id}', 'FrontEndController@authorDetail');
    Route::get('/category/{id}', 'FrontEndController@categoryPage');
    Route::get('/cart', 'CartController');
});

Route::prefix('admin')->middleware(['auth:sanctum', 'auth.admin'])->group(function() {
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::resource('/authors', 'AuthorController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/books', 'BookController');
    Route::resource('/users', 'UserController')->except(['edit', 'update', 'delete']);
    Route::resource('/shipping-methods', 'ShippingMethodController')->except('show');
});

Route::prefix('user')->middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', 'UserProfileController')->name('user.dashboard');
    Route::resource('/methods', 'PaymentMethodController')->except('show');
});
