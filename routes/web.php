<?php

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

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/search', 'SearchController@show');
Route::get('/products/json', 'SearchController@data');

Route::get('/home', 'HomeController@cart')->name('home');
Route::get('/orders', 'HomeController@orders')->name('orders');

Route::get('/products/{id}', 'ProductController@show');
Route::get('/categories/{category}', 'CategoryController@show');

Route::post('/cart', 'CartDetailController@store');
Route::post('/cart/{cartDetail}/edit', 'CartDetailController@update');
Route::delete('/cart', 'CartDetailController@destroy');

Route::post('/order', 'CartController@update');

Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/products', 'ProductController@index'); //listado
    Route::get('/products/create', 'ProductController@create'); //formulario
    Route::post('/products', 'ProductController@store'); //registrar
    Route::get('/products/{id}/edit', 'ProductController@edit'); //formulario editar
    Route::get('/products/{id}/edit-stock', 'ProductController@editStock'); //formulario editar stock
    Route::put('/products/{id}/edit', 'ProductController@update'); //actualizar
    Route::delete('/products/{id}', 'ProductController@destroy'); //form eliminar

    Route::get('/products/{id}/images', 'ImageController@index'); //listado
    Route::post('/products/{id}/images', 'ImageController@store'); //registrar
    Route::delete('/products/{id}/images', 'ImageController@destroy'); //form eliminar
    Route::get('/products/{id}/images/select/{image_id}', 'ImageController@select'); //destacar

    Route::get('/categories', 'CategoryController@index'); //listado
    Route::get('/categories/create', 'CategoryController@create'); //formulario
    Route::post('/categories', 'CategoryController@store'); //registrar
    Route::get('/categories/{category}/edit', 'CategoryController@edit'); //formulario editar
    Route::post('/categories/{category}/edit', 'CategoryController@update'); //actualizar
    Route::delete('/categories/{category}', 'CategoryController@destroy'); //form eliminar

});
