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
    Route::get('/checkout', 'OrderController@create');
    Route::post('/checkout', 'OrderController@store');
    // Route::redirect('/checkout/payment', '/checkout/success', 301); // This route would redirect to an external payment gate
    Route::get('/checkout/success', 'OrderController@success');
    Route::post('/checkout/register', 'CustomerController@store')->name('customers.store');
    Route::get('/contact', 'ContactFormController@create')->name('contact.create');
    Route::post('/contact', 'ContactFormController@store')->name('contact.store');
});

Route::prefix('admin')->middleware(['auth:sanctum', 'auth.admin'])->group(function() {
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::resource('/authors', 'AuthorController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/books', 'BookController');
    Route::resource('/users', 'UserController')->middleware('auth.superuser')->except(['edit', 'update', 'destroy'])->middleware('auth.superuser');
    Route::resource('/shipping-methods', 'ShippingMethodController')->except('show')->middleware('auth.superuser');
    Route::resource('/customers', 'CustomerController')->except(['create', 'store'])->middleware('auth.superuser');
    Route::resource('/refunds', 'OrderReturnController')->middleware('auth.superuser');
    Route::get('/orders', 'OrderController@list')->name('orders.index')->middleware('auth.superuser');
    Route::resource('/orders', 'OrderController')->except(['index', 'create', 'store'])->middleware('auth.superuser');
    Route::resource('/contact', 'ContactFormController')->only(['index', 'show', 'destroy'])->middleware('auth.superuser');
    Route::post('/contact/{contact}/complete', 'ContactFormController@complete')->middleware('auth.superuser');
});

Route::prefix('user')->middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', 'UserProfileController@index')->name('user.dashboard');
    Route::get('/orders', 'UserProfileController@orders')->name('user.orders');
    Route::get('/orders/{order}', 'UserProfileController@order')->name('user.order');
    Route::get('/orders/{order}/refund', 'UserProfileController@refund')->name('refund.create');
    Route::post('/orders/{order}/refund', 'UserProfileController@refundStore')->name('refund.store');
    Route::resource('/methods', 'PaymentMethodController')->except('show');
});

// Section main page redirects
Route::redirect('/admin', '/admin/dashboard');
Route::redirect('/user', '/user/dashboard');
