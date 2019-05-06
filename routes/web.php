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
})->name('subscribe')->middleware('auth');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


// Routes for logged in user
Route::middleware('auth')->get('/mystories', 'StoriesController@mystories')->name('stories.mystories');
Route::middleware('auth')->get('/create-story', 'StoriesController@create')->name('story.create');
Route::middleware('auth')->post('/create-story', 'StoriesController@store')->name('story.create');
Route::get('/favorites', 'BookmarkController@index')->name('bookmark');

// Routes for stories
Route::get('/stories', 'StoriesController@index')->name('stories.index');
Route::get('/stories/{story}', 'StoriesController@show')->name('story.show');

// Routes for categories
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/{id}/stories', 'CategoryController@stories')->name('categories.stories');


//routes for payment
Route::post('/pay', [
    'uses' => 'PaymentController@redirectToGateway',
    'as' => 'pay'
])->middleware('auth');

Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
