<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Http\Resources\Tweet\TweetsCollection;
use App\Tweet;
use App\TweetMedia;
use App\Tweets\TweetsRelations;
use App\Tweets\TweetTypes;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only('store');
    }

    public function index(Request $request)
    {
        $tweets = Tweet::with($this->getEagerLoadedRelations())->find(explode(",", $request->ids));

        return new TweetsCollection($tweets);
    }

    public function store(TweetStoreRequest $request)
    {

        $tweet_arr = array_merge($request->only(['body']), [
            'type' => TweetTypes::TWEET
        ]);

        $tweet = $request->user()->tweets()->create($tweet_arr);

        collect($request->media)->each(function ($id) use ($tweet) {
           $tweet->media()->save(TweetMedia::find($id));
        });

        $usersMentioned = $tweet->mentions->users();

        dd($usersMentioned);

        broadcast(new TweetWasCreated($tweet));
    }

    protected function getEagerLoadedRelations()
    {
        return TweetsRelations::$eagerloadedRelations;
    }
}
