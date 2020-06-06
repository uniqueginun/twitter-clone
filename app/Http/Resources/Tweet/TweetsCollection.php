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
}