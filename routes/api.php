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

	Route::middleware('auth:api')->post('/auth/logout', "AuthController@logout");


	Route::middleware('auth:api')->get('/auth/user', "AuthController@details");

	Route::middleware('auth:api')->put('/auth/change-password', "AuthController@changePassword");

	Route::post('/password-reset', "PasswordController@store");
	Route::put('/password-reset', "PasswordController@update");

	/**
	 * Routes for users
	 */
	Route::middleware('auth:api')->get('/users/stories', "UserController@stories");
	Route::middleware('auth:api')->get('/users/profile', "UserController@showProfile");

	Route::middleware('auth:api')->put('/users/profile', "UserController@updateProfile");

	Route::middleware('auth:api')->post('/users/profile/update-image', "UserController@updateProfileImage");

	Route::get('/users', "UserController@index");

	/**
	 * Routes for bookmarks
	 */
    Route::middleware('auth:api')->get('/bookmarks/stories', "BookmarkController@index");
	Route::middleware('auth:api')->post('/bookmarks/stories/{storyId}', "BookmarkController@add");

	Route::middleware('auth:api')->delete('/bookmarks/stories/{storyId}', "BookmarkController@remove");

	Route::middleware('auth:api')->get('/bookmarks/stories/{storyId}/status', "BookmarkController@status");

	/**
	 * Routes for categories
	 */
	Route::get('/categories', "CategoryController@index");

	Route::get('/categories/{id}', "CategoryController@show");

	Route::get('/categories/{id}/stories', "CategoryController@categoryStories");

	/**
	 * Routes for stories
	 */
	Route::middleware('auth:api')->post('/stories', "StoryController@store");

	Route::get('/stories', "StoryController@index");
	Route::get('/stories/{id}', "StoryController@show");

	// Route::get('/stories/{id}', "StoryController@show");

	Route::middleware('auth:api')->post('/stories/{id}', "StoryController@update");

	Route::middleware('auth:api')->post('/stories/{storyId}/reactions/like', "StoryController@like");

	Route::middleware('auth:api')->post('/stories/{storyId}/reactions/dislike', "StoryController@dislike");

	/**
	 * Routes for comment
	 */
	Route::middleware('auth:api')->post('/comments', "CommentsController@store");

	Route::middleware('auth:api')->put('/comments/{id}', "CommentsController@update");

	Route::middleware('auth:api')->delete('/comments/{id}', "CommentsController@destory");

	/**
	 * Routes for payment
	 */
	Route::middleware('auth:api')->post('/payments', "PaymentController@store");

	/**
     * Routes for tags
     */
    Route::get('/tags','TagController@index');

    Route::get('/tags/stories/search/{tagName}', 'TagController@storiesByTag');
