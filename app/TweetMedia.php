<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use App\Media\Media;

class TweetMedia extends Model implements HasMedia
{

    use HasMediaTrait;

    protected $guarded = [];

    public function baseMedia()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
}
