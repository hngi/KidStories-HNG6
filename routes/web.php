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


Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/subscribe', function () {
    return view('subscribe');
})->name('subscribe');


Route::get('/story', 'StoriesController@index')->name('reaction');
Route::get('/browsestories', 'StoriesController@browsestories')->name('stories.browsestories');
Route::middleware('auth')->get('/mystories', 'StoriesController@mystories')->name('stories.mystories');
Route::get('/story/{id}', 'StoriesController@singlestory')->name('singlestory');

Route::middleware('auth')->get('/create-story', 'StoriesController@create')->name('story.create');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/favorites', 'BookmarkController@index')->name('bookmark');

Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/{id}/stories', 'CategoryController@stories')->name('categories.stories');

Route::get('/categories/stories/search/', 'StoriesController@search')->name('stories.search');

Route::middleware('auth')->post('/create-story', 'StoriesController@store')->name('story.create');

Route::get('/show-story/{story}', 'StoriesController@show')->name('story.show');
