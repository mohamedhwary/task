<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('products', 'ProductController@index')->name('products');
Route::get('products/list', 'ProductController@getProducts')->name('products.list');
Route::POST('products/removeQuantity', 'ProductController@removeQuantity')->name('removeQuantity');
Route::POST('products/getProduct', 'ProductController@getProduct')->name('getProduct');
Route::POST('products/updateProduct', 'ProductController@updateProduct')->name('updateProduct');
Route::POST('products/deleteProduct', 'ProductController@deleteProduct')->name('deleteProduct');
Route::POST('products/newProduct', 'ProductController@newProduct')->name('newProduct');

Route::get('categories', 'CategoryController@index')->name('categories');
Route::get('categories/list', 'CategoryController@getCategories')->name('categories.list');

Route::get('users', 'UserController@index')->name('users');
Route::get('users/list', 'UserController@getUsers')->name('users.list');

