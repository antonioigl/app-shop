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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products/{id}', 'ProductController@show');

Route::post('/cart', 'CartDetailController@store');

Route::middleware(['auth', 'admin'])->prefix('admin')->namespace('Admin')->group(function () {

    Route::get('/products', 'ProductController@index'); //listado
    Route::get('/products/create', 'ProductController@create'); //formulario
    Route::post('/products', 'ProductController@store'); //registrar
    Route::get('/products/{id}/edit', 'ProductController@edit'); //formulario editar
    Route::post('/products/{id}/edit', 'ProductController@update'); //actualizar
    Route::delete('/products/{id}', 'ProductController@destroy'); //form eliminar

    Route::get('/products/{id}/images', 'ImageController@index'); //listado
    Route::post('/products/{id}/images', 'ImageController@store'); //registrar
    Route::delete('/products/{id}/images', 'ImageController@destroy'); //form eliminar
    Route::get('/products/{id}/images/select/{image_id}', 'ImageController@select'); //destacar

});
