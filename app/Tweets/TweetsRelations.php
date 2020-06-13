<?php

namespace App\Tweets;

class TweetsRelations
{
    public static $eagerloadedRelations = [
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
    ];

}