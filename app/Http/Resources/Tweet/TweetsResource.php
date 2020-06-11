<?php

namespace App\Http\Resources\Tweet;

use App\Http\Resources\Media\MediaCollection;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'type' => $this->type,
            'original_tweet' => new TweetsResource($this->originalTweet),
            'likes_count' => $this->likes->count(),
            'retweets_count' => $this->retweets->count(),
            'user' => new UserResource($this->user),
            'media' => new MediaCollection($this->media),
            'created_at' => $this->created_at->timestamp
        ];
    }
}