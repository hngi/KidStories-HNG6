<?php

/**
 * Super-admin authentication routes
 *
 */
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login.form');

Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');

Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');

Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.post.register');


Route::group( ['middleware' => ['admin']], function() {
    Route::get('/dashboard', 'AdminDashboardController@index')->name('admin.dashboard');
    Route::put('/change-password', 'AdminDashboardController@changePassword')->name('admin.password.change');
    Route::get('/profile', 'AdminDashboardController@profile')->name('admin.profile');



});


/*



$this->get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm');
$this->post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail');
$this->get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm');
$this->post('/password/reset', 'Auth\AdminResetPasswordController@reset');*/

/**
 * Category routes for superadmin operations
 *
 */
Route::resource('/categories', 'CategoryController', ['as' => 'admin']);

/**
 * User routes for superadmin operations
 *
 */
Route::resource('/users', 'UserController');

/**
 * Stories routes for superadmin operations
 *
 */
Route::resource('/stories', 'StoryController',['as'=>'admin']);
