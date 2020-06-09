<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Events\Tweets\TweetRetweetsUpdated;
use App\Events\Tweets\TweetWasCreated;
use App\Events\Tweets\TweetWasDeleted;
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
        $retweet = $request->user()->tweets()->create([
            'type' => TweetTypes::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetWasCreated($retweet));

        broadcast(new TweetRetweetsUpdated($request->user(), $tweet));
    }

    public function destroy(Tweet $tweet, Request $request)
    {
        $ActualRetweet = $tweet->retweets()->where('user_id', $request->user()->id)->first();

        broadcast(new TweetWasDeleted($ActualRetweet));

        $ActualRetweet->delete();

        broadcast(new TweetRetweetsUpdated($request->user(), $tweet));

    }
}
