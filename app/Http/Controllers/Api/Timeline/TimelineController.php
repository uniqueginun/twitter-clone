<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tweet\TweetsCollection;
use Illuminate\Http\Request;

class TimelineController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        $tweets = $request->user()
                        ->tweetsFromFollowing()
                        ->parent()
                        ->with([
                            'user',
                            'originalTweet',
                            'likes',
                            'media.baseMedia',
                            'retweets',
                            'replies',
                            'originalTweet.user',
                            'originalTweet.originalTweet',
                            'originalTweet.likes',
                            'originalTweet.media.baseMedia',
                            'originalTweet.retweets',
                        ])
                        ->paginate(8);

        return new TweetsCollection($tweets);
    }
}