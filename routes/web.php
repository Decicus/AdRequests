<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'GeneralController@home']);
Route::get('login', ['as' => 'login', 'uses' => 'GeneralController@login']);

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
        Route::get('settings', ['as' => 'settings', 'uses' => 'AccountController@settings']);
    });
    
    Route::group(['prefix' => 'api', 'as' => 'api.'], function() {
        Route::group(['prefix' => 'submit', 'as' => 'submit'], function() {
            
        });
    });
    
    Route::group(['prefix' => 'requests', 'as' => 'requests.'], function() {
        Route::group(['prefix' => 'submit', 'as' => 'submit.'], function() {
            Route::get('/', ['as' => 'base', 'uses' => 'SubmitController@base']);
            Route::get('desktop', ['as' => 'desktop', 'uses' => 'SubmitController@desktop']);
            Route::get('other', ['as' => 'other', 'uses' => 'SubmitController@other']);
            Route::get('video', ['as' => 'video', 'uses' => 'SubmitController@video']);
            Route::get('web', ['as' => 'web', 'uses' => 'SubmitController@web']);

            
            Route::group(['prefix' => 'ama', 'as' => 'ama.'], function() {
                Route::get('business', ['as' => 'business', 'uses' => 'SubmitController@amaBusiness']);
                Route::get('streamer', ['as' => 'streamer', 'uses' => 'SubmitController@amaStreamer']);
            });
        });
    });
});

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
    Route::group(['prefix' => 'reddit', 'as' => 'reddit.'], function() {
        Route::get('/', ['as' => 'redirect', 'uses' => 'RedditAuthController@redirectToAuth']);
        Route::get('callback', ['as' => 'callback', 'uses' => 'RedditAuthController@callback']);
        Route::get('logout', ['as' => 'logout', 'uses' => 'RedditAuthController@logout']);
    });
    
    Route::group(['prefix' => 'twitch', 'as' => 'twitch.', 'middleware' => ['auth']], function() {
        Route::get('/', ['as' => 'redirect', 'uses' => 'TwitchAuthController@redirectToAuth']);
        Route::get('callback', ['as' => 'callback', 'uses' => 'TwitchAuthController@callback']);
        Route::get('disconnect', ['as' => 'disconnect', 'uses' => 'TwitchAuthController@disconnect']);
    });
});
