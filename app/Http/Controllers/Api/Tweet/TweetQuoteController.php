<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Events\Tweets\TweetRetweetsUpdated;
use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Tweet;
use App\Tweets\TweetTypes;

class TweetQuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(Tweet $tweet, TweetStoreRequest $request)
    {
        $quote = $request->user()->tweets()->create([
            'type' => TweetTypes::QUOTE,
            'body' => $request->body,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetWasCreated($quote));

        broadcast(new TweetRetweetsUpdated($request->user(), $tweet));
    }
}
