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

Route::get('/admin', function () {
    return view('admin.welcome');
});

Route::get('/', function () {
    return view('home');
})->name('homepage');

Route::get('/story/{id}', 'StoriesController@singlestory')->name('singlestory');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/favorites', 'BookmarkController@index')->name('bookmark');
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/{id}', 'CategoryController@show')->name('stories');

Route::middleware('auth')->get('/create-story', 'StoriesController@create')->name('story.create');
