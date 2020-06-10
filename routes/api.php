<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api'], function () {

    Route::get('timeline', 'Timeline\TimelineController@index');

    Route::post('tweets', 'Tweet\TweetController@store');

    Route::post('tweets/{tweet}/likes', 'Tweet\LikeTweetController@store');
    Route::delete('tweets/{tweet}/likes', 'Tweet\LikeTweetController@destroy');

    Route::post('tweets/{tweet}/retweets', 'Tweet\TweetRetweetController@store');
    Route::delete('tweets/{tweet}/retweets', 'Tweet\TweetRetweetController@destroy');

    Route::get('media/types', 'Media\MediaTypesController@index');

});
