<?php

namespace App\Http\Controllers\Api\Tweet;

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
        // make sure user can't like a tweet twice
        if ($request->user()->hasLiked($tweet)) {
            return response(null, 409);
        }

        $request->user()->likes()->create([
            'tweet_id' => $tweet->id
        ]);
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        $request->user()->likes()->where('tweet_id', $tweet->id)->first()->delete();
    }
}
