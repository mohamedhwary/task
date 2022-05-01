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
Route::get('products/create', 'ProductController@create')->name('products.create');
Route::POST('products/removeQuantity', 'ProductController@removeQuantity')->name('removeQuantity');
Route::POST('products/getProduct', 'ProductController@getProduct')->name('getProduct');
Route::POST('products/updateProduct', 'ProductController@updateProduct')->name('updateProduct');
Route::POST('products/deleteProduct', 'ProductController@deleteProduct')->name('deleteProduct');
Route::POST('products/newProduct', 'ProductController@newProduct')->name('product.newProduct');

Route::get('categories', 'CategoryController@index')->name('categories');
Route::get('categories/list', 'CategoryController@getCategories')->name('categories.list');
Route::get('categories/create', 'CategoryController@newUser')->name('category.create');
Route::POST('categories/getCategory', 'CategoryController@getCategory')->name('getCategory');
Route::POST('categories/updateCategory', 'CategoryController@updateCategory')->name('updateCategory');
Route::POST('categories/deleteCategory', 'CategoryController@deleteCategory')->name('deleteCategory');
Route::POST('categories/newCategory', 'CategoryController@newCategory')->name('category.newCategory');



Route::get('users', 'UserController@index')->name('users');
Route::get('users/list', 'UserController@getUsers')->name('users.list');
Route::get('users/create', 'UserController@create')->name('user.create');
Route::POST('users/getUser', 'UserController@getUser')->name('getUser');
Route::POST('users/updateUser', 'UserController@updateUser')->name('updateUser');
Route::POST('users/deleteUser', 'UserController@deleteUser')->name('deleteUser');
Route::POST('users/newUser', 'UserController@newUser')->name('user.newUser');

