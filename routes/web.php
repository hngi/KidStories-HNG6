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

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/profile', 'UserController@showProfile')->name('profile')->middleware(['auth', 'verified']);
Route::put('/profile', 'UserController@updateProfile')->name('profile.update')->middleware(['auth', 'verified']);

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/subscribe', function () {
    return view('subscribe');
})->name('subscribe')->middleware('auth');

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');

// Routes for social media auth
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('auth.social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('auth.social.callback');


// Routes for logged in user
Route::middleware(['auth', 'verified'])->get('/mystories', 'StoriesController@mystories')->name('stories.mystories');
Route::middleware(['auth', 'verified'])->get('/stories/create', 'StoriesController@create')->name('story.create');
Route::middleware(['auth', 'verified'])->post('/stories/create', 'StoriesController@store')->name('story.store');
Route::middleware(['auth', 'verified'])->get('/stories/{story}/edit', 'StoriesController@edit')->name('story.edit');
Route::middleware(['auth', 'verified'])->get('/stories/{story}/delete', 'StoriesController@destroy')->name('story.delete');
Route::middleware(['auth', 'verified'])->put('/stories/{story}', 'StoriesController@update')->name('story.update');
Route::get('/favorites', 'BookmarkController@index')->name('bookmark');

// Routes for stories
Route::get('/stories', 'StoriesController@index')->name('stories.index');
Route::get('/stories/{story}', 'StoriesController@show')->name('story.show');
Route::get('/trending-stories', 'StoriesController@trendingstories')->name('stories.trending');

/**
 * Routes for comment
 */
// Route::middleware(['auth', 'verified'])->get('/comments/{id}', "CommentsController@index");
Route::middleware(['auth', 'verified'])->post('/comments', "CommentsController@store");
Route::middleware(['auth', 'verified'])->put('/comments/{id}', "CommentsController@update");
Route::middleware(['auth', 'verified'])->delete('/comments/{id}', "CommentsController@destory");

// Routes for categories
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/{id}/stories', 'CategoryController@stories')->name('categories.stories');

// Routes for authors
Route::get('/authors/{author}/stories', 'AuthorController@getStories')->name('author.stories');

// Routes for feedbacks
Route::post('/feedbacks', 'FeedbackController@create')->name('feedbacks.create');

//routes for payment
Route::post('/pay', [
    'uses' => 'PaymentController@redirectToGateway',
    'as' => 'pay'
])->middleware(['auth', 'verified']);

Route::get('/payment/callback', 'PaymentController@handleGatewayCallback')->name('pay.callback');


Route::get('/newsletter/subscribe', 'NewsletterController@subscribe')->name('newsletter.subscribe');
Route::get('/newsletter/api', 'NewsletterController@sendCampaigns')->name('newsletter.send');
