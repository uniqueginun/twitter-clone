<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Tweets\TweetTypes;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('store');
    }

    public function store(TweetStoreRequest $request)
    {

        $tweet_arr = array_merge($request->only(['body']), [
            'type' => TweetTypes::TWEET
        ]);

        $tweet = $request->user()->tweets()->create($tweet_arr);

        broadcast(new TweetWasCreated($tweet));
    }
}
