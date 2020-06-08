<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Events\Tweets\TweetLikesWereUpdated;
use App\Http\Controllers\Controller;
use App\Tweet;
use Illuminate\Http\Request;

class LikeTweetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(Tweet $tweet, Request $request)
    {

        if ($request->user()->hasLiked($tweet)) {
            return response(null, 409);
        }

        $request->user()->likes()->create([
            'tweet_id' => $tweet->id
        ]);

        broadcast(new TweetLikesWereUpdated($request->user(), $tweet));
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        $request->user()->likes()->where('tweet_id', $tweet->id)->first()->delete();
    }
}
