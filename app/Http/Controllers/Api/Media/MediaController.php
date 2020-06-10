<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaStoreRequest;
use App\Http\Resources\Media\TweetMediaCollection;
use App\TweetMedia;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:sanctum');
    }

    public function store(MediaStoreRequest $request)
    {
        $result = collect($request['media'])->map(function ($mediaElement) {
           return $this->addMedia($mediaElement);
        });

        return new TweetMediaCollection($result);
    }

    protected function addMedia($mediaElement)
    {
        $tweetMedia = TweetMedia::create([]);

        $tweetMedia
            ->baseMedia()
            ->associate(
                $tweetMedia
                    ->addMedia($mediaElement)
                    ->toMediaCollection()
            )
            ->save();

        return $tweetMedia;
    }
}
