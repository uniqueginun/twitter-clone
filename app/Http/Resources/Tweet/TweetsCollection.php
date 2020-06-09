<?php

namespace App\Http\Resources\Tweet;

use App\Http\Resources\Tweet\TweetsResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TweetsCollection extends ResourceCollection
{

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = TweetsResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'likes' => $this->likes($request),
                'retweets' => $this->retweets($request)
            ],
        ];
    }

    /**
     * define all tweets in this resource that been liked by the current user
     * @param \Illuminate\Http\Request $request
     * @return array of likes
     */

    protected function likes(\Illuminate\Http\Request $request)
    {

        if (!$user = $request->user()) {
            return [];
        }

        return $user->likes()
                    ->whereIn(
                        'tweet_id',
                        $this->collection->pluck('id')
                            ->merge($this->collection->pluck('original_tweet_id'))
                    )
                    ->pluck('id')
                    ->toArray();
    }

    protected function retweets(\Illuminate\Http\Request $request)
    {
        if (!$user = $request->user()) {
            return [];
        }

        return $user->retweets()
                    ->whereIn(
                        'original_tweet_id',
                        $this->collection->pluck('id')
                            ->merge($this->collection->pluck('original_tweet_id'))
                    )
                    ->pluck('original_tweet_id')
                    ->toArray();
    }
}