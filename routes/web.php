<?php

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('invite/confirm/{remember_token}', 'InvateController@confirm')->name('invite.confirm');

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'ProjectController@index')->name('index');
    Route::resource('projects', 'ProjectController', ['only' => ['index', 'show']]);
    Route::resource('idea', 'IdeaController');
    Route::post('like/{entityName}/{entity}', 'LikeController@store');
    Route::delete('like/{entityName}/{entity}', 'LikeController@destroy');
    Route::resource('projects/{project}/comments', 'CommentController');

    Route::get('change/password', 'ChangePasswordController@show')->name('change.password');
    Route::put('change/password', 'ChangePasswordController@update')->name('update.password');

    Route::get('user/{user}/profile', 'ProfileController@show' )->name('user.profile');
    Route::put('user/profile', 'ProfileController@update')->name('user.update');
    Route::resource('meetings','MeetingController', ['only' => ['index', 'show']]);
    Route::resource('technologies','TechnologyController', ['only' => ['index']]);
    Route::post('{entityName}/{entity}/reply', 'ReplyController@store')->name('reply.store');

    Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function () {
        Route::resource('projects', 'ProjectController', ['except' => ['index', 'show']]);
        Route::get('invite', 'InvateController@create')->name('invite.create');
        Route::post('invite', 'InvateController@store')->name('invite.store');
        Route::get('comment','CommentController@index')->name('comment.index');
        Route::resource('users','UserController');
        Route::resource('meetings','MeetingController', ['except' => ['index', 'show']]);
        Route::resource('technologies','TechnologyController', ['except' => ['index', 'show']]);
        Route::get('projects/{project}/technologies', 'ProjectTechnologyController@edit')->name('projects.technologies.edit');
        Route::put('projects/{project}/technologies', 'ProjectTechnologyController@update')->name('projects.technologies.update');

        Route::get('users/{user}/technologies', 'TechnologyUserController@edit')->name('users.technologies.edit');
        Route::put('users/{user}/technologies', 'TechnologyUserController@update')->name('users.technologies.update');
        Route::get('users/{user}/projects', 'UserProjectController@edit')->name('users.projects.edit');
        Route::put('users/{user}/projects', 'UserProjectController@update')->name('users.projects.update');

        Route::get('statistic/{user}', 'StatisticController@show')->name('statistics.user.show');

        Route::delete('reply/{reply}', 'ReplyController@destroy')->name('reply.destroy');
        Route::get('reply/{reply}', 'ReplyController@edit')->name('reply.edit');
        Route::put('reply/{reply}', 'ReplyController@update')->name('reply.update');
    });
});
