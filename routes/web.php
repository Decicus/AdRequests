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
Route::get('privacy-policy', ['as' => 'privacy-policy', 'uses' => 'GeneralController@privacyPolicy']);
Route::get('proxy', ['as' => 'imageproxy', 'uses' => 'GeneralController@imageProxy'])->middleware('auth.verify');
Route::get('submit', ['as' => 'submit', 'uses' => 'GeneralController@submit']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function() {
    Route::get('/', ['as' => 'base', 'uses' => 'AdminController@base']);
    Route::post('approval', ['as' => 'approval', 'uses' => 'AdminController@approval']);
    Route::get('search', ['as' => 'search', 'uses' => 'AdminController@search']);
    Route::get('requests', ['as' => 'requests', 'uses' => 'AdminController@requests']);
    Route::get('twitch', ['as' => 'twitch', 'uses' => 'AdminController@twitch']);
    Route::post('twitch/remove', ['as' => 'twitch.remove', 'uses' => 'AdminController@removeTwitch']);

    Route::group(['prefix' => 'helpers', 'as' => 'helpers.'], function() {
        Route::get('/', ['as' => 'base', 'uses' => 'AdminController@helpers']);
        Route::post('add', ['as' => 'add', 'uses' => 'ManageHelpersController@add']);
        Route::post('delete', ['as' => 'delete', 'uses' => 'ManageHelpersController@delete']);
    });
});

/*
Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => 'auth'], function() {
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
        Route::get('me', ['as' => 'base', 'uses' => 'UserController@me']);
        Route::get('votes', ['as' => 'votes', 'uses' => 'UserController@votes']);
    });

    Route::group(['prefix' => 'requests', 'as' => 'requests.', 'middleware' => 'admin'], function() {
        Route::group(['prefix' => 't', 'as' => 'twitch.'], function() {
            Route::get('{id?}', ['as' => 'user', 'uses' => 'RequestsController@twitchUser'])
                ->where('id', '[\d]+');
        });
    });

    Route::group(['prefix' => 'types', 'as' => 'types.'], function() {
        Route::get('approvals', ['as' => 'approvals', 'uses' => 'ApiController@approvalTypes']);
        Route::get('requests', ['as' => 'requests', 'uses' => 'ApiController@requestTypes']);
    });

    Route::group(['prefix' => 'votes', 'as' => 'votes.', 'middleware' => 'helper'], function() {
        Route::get('{request_id}', ['as' => 'base', 'uses' => 'VoteController@votes']);
        Route::post('submit', ['as' => 'submit', 'uses' => 'VoteController@submit']);
    });
});
*/

Route::group(['prefix' => 'helper', 'as' => 'helper.', 'middleware' => ['helper']], function() {
    Route::get('requests', ['as' => 'requests', 'uses' => 'HelperController@requests']);
});

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => ['admin']], function() {
    Route::get('{user}', ['as' => 'user', 'uses' => 'UserController@user']);
});

Route::group(['middleware' => ['auth.verify']], function() {
    Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
        Route::get('settings', ['as' => 'settings', 'uses' => 'AccountController@settings']);
    });

    Route::group(['prefix' => 'comments', 'as' => 'comments.'], function() {
        Route::post('add', ['as' => 'add', 'uses' => 'CommentController@add']);
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
    });
});
