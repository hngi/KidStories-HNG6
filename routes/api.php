<?php
	
	/**
	 * Routes for users
	 */
	Route::post('/user/register',"UserController@register");

	Route::post('/user/login', "UserController@login");

	Route::middleware('auth:api')->get('/user/profile/{id}', "UserController@profile");

	Route::get('/user/login', "UserController@login");

	Route::middleware('auth:api')->get('/user/edit/{id}', "UserController@update");

	Route::get('/user/all', "UserController@index");

	/**
	 * Routes for bookmarks
	 */
	Route::middleware('auth:api')->post('/bookmark/story/{storyId}/user/{userId}', "BookmarkController@add");

	Route::middleware('auth:api')->delete('/bookmark/story/{storyId}/user/{userId}', "BookmarkController@remove");

	/**
	 * Routes for bookmarks
	 */
	Route::middleware('auth:api')->post('/story/create', "StoryController@create");

	Route::get('/story', "StoryController@index");

	Route::get('/story/{id}', "StoryController@show");

	Route::get('/story/category/{categoryId}', "StoryController@storyByCategory");

	Route::middleware('auth:api')->put('/story/edit/{id}', "StoryController@update");

	Route::middleware('auth:api')->put('/story/like/{storyId}', "StoryController@storyReaction");
