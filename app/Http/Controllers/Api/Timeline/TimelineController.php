<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\Tweet\TweetsCollection;
use App\Tweets\TweetsRelations;
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
                        ->with($this->getEagerLoadedRelations())
                        ->paginate(8);

        return new TweetsCollection($tweets);
    }

    protected function getEagerLoadedRelations()
    {
        return TweetsRelations::$eagerloadedRelations;
    }
}