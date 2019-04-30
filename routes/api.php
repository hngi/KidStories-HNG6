<?php
	// Route check 1... 2... :-)
	Route::get('/test', function () {
	    return response()->json(['message' => 'You are set!']);
	});

	/**
	 * Routes for authentication
	 */
	Route::post('/auth/register', "AuthController@register");

	Route::post('/auth/login', "AuthController@login");

	Route::middleware('authApi')->post('/auth/logout', "AuthController@logout");


	Route::middleware('authApi')->get('/auth/user', "AuthController@details");

	Route::middleware('authApi')->put('/auth/change-password', "AuthController@changePassword");

	/**
	 * Routes for users
	 */
	Route::middleware('authApi')->get('/users/profile', "UserController@showProfile");

	Route::middleware('authApi')->put('/users/profile', "UserController@updateProfile");

	Route::middleware('authApi')->post('/users/profile/update-image', "UserController@updateProfileImage");

	Route::get('/users', "UserController@index");

	/**
	 * Routes for bookmarks
	 */
	Route::middleware('authApi')->post('/bookmarks/stories/{storyId}', "BookmarkController@add");

	Route::middleware('authApi')->delete('/bookmarks/stories/{storyId}', "BookmarkController@remove");

	Route::middleware('authApi')->get('/bookmarks/stories/{storyId}/status', "BookmarkController@status");

	/**
	 * Routes for categories
	 */
	Route::get('/categories', "CategoryController@index");

	Route::get('/categories/{id}/stories', "CategoryController@categoryStories");

	/**
	 * Routes for stories
	 */
	Route::middleware('authApi')->post('/stories', "StoryController@store");

	Route::get('/stories', "StoryController@index");

	Route::get('/stories/{id}', "StoryController@show");

	Route::middleware('authApi')->post('/stories/{id}', "StoryController@update");

	Route::middleware('authApi')->post('/stories/{storyId}/reactions/like', "StoryController@like");

	Route::middleware('authApi')->post('/stories/{storyId}/reactions/dislike', "StoryController@dislike");

	/**
	 * Routes for comment
	 */
	Route::middleware('authApi')->post('/comments', "CommentsController@store");

	Route::middleware('authApi')->put('/comments/{id}', "CommentsController@update");

	Route::middleware('authApi')->delete('/comments/{id}', "CommentsController@destory");

	/**
	 * Routes for payment
	 */
	Route::middleware('authApi')->post('/payments', "PaymentController@store");
