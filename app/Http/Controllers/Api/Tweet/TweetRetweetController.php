<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Http\Controllers\Controller;
use App\Tweet;
use App\Tweets\TweetTypes;
use Illuminate\Http\Request;

class TweetRetweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(Tweet $tweet, Request $request)
    {
        $request->user()->tweets()->create([
            'type' => TweetTypes::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        $tweet->retweets()->where('user_id', $request->user()->id)->first()->delete();
    }
}
