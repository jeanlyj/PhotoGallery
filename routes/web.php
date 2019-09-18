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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/galleries', 'GalleriesController@index')->name('galleries.index');
Route::get('/galleries/create', 'GalleriesController@create')->name('galleries.create');
Route::post('/galleries', 'GalleriesController@store')->name('galleries.store');
Route::get('/galleries/{id}', 'GalleriesController@show')->name('galleries.show');
Route::get('/galleries/{id}/edit', 'GalleriesController@edit')->name('galleries.edit');
Route::patch('/galleries/{id}', 'GalleriesController@update')->name('galleries.update');
Route::delete('/galleries/{id}', 'GalleriesController@destroy')->name('galleries.destroy');

Route::get('/slides/create/{galleryId}', 'SlidesController@create')->name('slides.create');
Route::post('/slides/store', 'SlidesController@store')->name('slides.store');
Route::get('/slides/{id}', 'SlidesController@show')->name('slides.show');
Route::delete('/slides/{id}', 'SlidesController@destroy')->name('slides.destroy');