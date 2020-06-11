<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Events\Tweets\TweetRetweetsUpdated;
use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Tweet;
use App\TweetMedia;
use App\Tweets\TweetTypes;
use Illuminate\Http\Request;

class TweetReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function store(Tweet $tweet, TweetStoreRequest $request)
    {
        $reply = $request->user()->tweets()->create([
            'type' => TweetTypes::TWEET,
            'body' => $request->body,
            'parent_id' => $tweet->id
        ]);

        collect($request->media)->each(function ($id) use ($reply) {
            $reply->media()->save(TweetMedia::find($id));
        });

        //broadcast(new TweetWasCreated($reply));

        //broadcast(new TweetRetweetsUpdated($request->user(), $tweet));
    }
}
