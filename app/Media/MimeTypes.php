<?php

namespace App\Media;

use phpDocumentor\Reflection\Types\Static_;

class MimeTypes
{
    public static $images = [
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/gif',
    ];

    public static $video = [
        'video/mp4'
    ];

    public static function all()
    {
        return array_merge(Static::$images, static::$video);
    }
}