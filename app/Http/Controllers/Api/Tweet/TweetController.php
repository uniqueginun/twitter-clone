<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Events\Tweets\TweetWasCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tweets\TweetStoreRequest;
use App\Http\Resources\Tweet\TweetsCollection;
use App\Notifications\Tweets\TweetMentionedIn;
use App\Tweet;
use App\TweetMedia;
use App\Tweets\TweetsRelations;
use App\Tweets\TweetTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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

        $usersMentioned = $tweet->mentions->users()->filter(function ($user) use ($request) {
            return ($user->id !== $request->user()->id);
        });

        Notification::send($usersMentioned, new TweetMentionedIn($request->user(), $tweet));

        broadcast(new TweetWasCreated($tweet));
    }

    public function show(Tweet $tweet)
    {
        $tweetFamily = collect([$tweet])->merge($tweet->parents());
        return new TweetsCollection($tweetFamily);
    }

    protected function getEagerLoadedRelations()
    {
        return TweetsRelations::$eagerloadedRelations;
    }
}
