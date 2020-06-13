<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Events\Tweets\TweetRepliesUpdated;
use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Http\Resources\Tweet\TweetsCollection;
use App\Notifications\Tweets\TweetRepliedTo;
use App\Tweet;
use App\TweetMedia;
use App\Tweets\TweetTypes;

class TweetReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('store');
    }

    public function show(Tweet $tweet)
    {
        return new TweetsCollection($tweet->replies);
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

        if ($request->user()->id === $tweet->user_id) {
            $tweet->user->notify(new TweetRepliedTo($request->user(), $reply));
        }

        broadcast(new TweetRepliesUpdated($tweet));
    }
}
