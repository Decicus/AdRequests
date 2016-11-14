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
Route::get('proxy', ['as' => 'imageproxy', 'uses' => 'GeneralController@imageProxy'])->middleware('auth');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function() {
    Route::get('/', ['as' => 'base', 'uses' => 'AdminController@base']);
    Route::post('approval', ['as' => 'approval', 'uses' => 'AdminController@approval']);
    Route::get('requests', ['as' => 'requests', 'uses' => 'AdminController@requests']);
    Route::get('twitch', ['as' => 'twitch', 'uses' => 'AdminController@twitch']);
    Route::post('twitch/remove', ['as' => 'twitch.remove', 'uses' => 'AdminController@removeTwitch']);

    Route::group(['prefix' => 'helpers', 'as' => 'helpers.'], function() {
        Route::get('/', ['as' => 'base', 'uses' => 'AdminController@helpers']);
        Route::post('add', ['as' => 'add', 'uses' => 'ManageHelpersController@add']);
        Route::post('delete', ['as' => 'delete', 'uses' => 'ManageHelpersController@delete']);
    });
});

Route::group(['prefix' => 'comments', 'as' => 'comments.', 'middleware' => ['admin']], function() {
    Route::post('add', ['as' => 'add', 'uses' => 'CommentController@add']);
});

Route::group(['prefix' => 'helper', 'as' => 'helper.', 'middleware' => ['helper']], function() {
    Route::get('requests', ['as' => 'requests', 'uses' => 'HelperController@requests']);
});

Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
        Route::get('settings', ['as' => 'settings', 'uses' => 'AccountController@settings']);
    });

    Route::group(['prefix' => 'requests', 'as' => 'requests.'], function() {
        Route::get('/', ['as' => 'base', 'uses' => 'RequestsController@base']);
        Route::get('/{id}', ['as' => 'id', 'uses' => 'RequestsController@id'])
            ->where('id', '([a-z0-9\-]{36})');

        Route::group(['prefix' => 'submit', 'as' => 'submit.'], function() {
            Route::get('/{type?}', ['as' => 'base', 'uses' => 'SubmitController@base'])
                ->where('type', '([A-z\.]+)');
            Route::post('desktop', ['as' => 'desktop', 'uses' => 'SubmitController@desktop']);
            Route::post('other', ['as' => 'other', 'uses' => 'SubmitController@other']);
            Route::post('video', ['as' => 'video', 'uses' => 'SubmitController@video']);
            Route::post('web', ['as' => 'web', 'uses' => 'SubmitController@web']);


            Route::group(['as' => 'ama.'], function() {
                Route::post('ama.business', ['as' => 'business', 'uses' => 'SubmitController@amaBusiness']);
                Route::post('ama.streamer', ['as' => 'streamer', 'uses' => 'SubmitController@amaStreamer']);
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
        // Route::get('disconnect', ['as' => 'disconnect', 'uses' => 'TwitchAuthController@disconnect']);
    });
});
