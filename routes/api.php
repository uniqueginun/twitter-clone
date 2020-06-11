<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {

    Route::get('timeline', 'Timeline\TimelineController@index');

    Route::post('tweets', 'Tweet\TweetController@store');

    Route::post('/tweets/{tweet}/replies', 'Tweet\TweetReplyController@store');

    Route::post('tweets/{tweet}/likes', 'Tweet\LikeTweetController@store');
    Route::delete('tweets/{tweet}/likes', 'Tweet\LikeTweetController@destroy');

    Route::post('tweets/{tweet}/retweets', 'Tweet\TweetRetweetController@store');
    Route::delete('tweets/{tweet}/retweets', 'Tweet\TweetRetweetController@destroy');

    Route::post('/tweets/{tweet}/quotes', 'Tweet\TweetQuoteController@store');

    Route::get('media/types', 'Media\MediaTypesController@index');

    Route::post('media', 'Media\MediaController@store');

    Route::get('/notifications', 'Notifications\NotificationController@index');

});
