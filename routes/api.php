<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth'], function() {
    Route::get('me', ['as' => 'base', 'uses' => 'UserController@me']);
    Route::get('votes', ['as' => 'votes', 'uses' => 'UserController@votes']);
});

Route::group(['prefix' => 'requests', 'as' => 'requests.', 'middleware' => ['auth:api', 'admin']], function() {
    Route::get('r/{id?}', ['as' => 'reddit.user', 'uses' => 'RequestsController@redditUser'])
        ->where('id', '[a-z0-9]+');
    Route::get('t/{id?}', ['as' => 'twitch.user', 'uses' => 'RequestsController@twitchUser'])
        ->where('id', '[\d]+');
});

Route::group(['prefix' => 'types', 'as' => 'types.'], function() {
    Route::get('approvals', ['as' => 'approvals', 'uses' => 'ApiController@approvalTypes']);
    Route::get('requests', ['as' => 'requests', 'uses' => 'ApiController@requestTypes']);
});

Route::group(['prefix' => 'votes', 'as' => 'votes.', 'middleware' => 'helper'], function() {
    Route::get('{request_id}', ['as' => 'base', 'uses' => 'VoteController@votes']);
    Route::post('submit', ['as' => 'submit', 'uses' => 'VoteController@submit']);
});
