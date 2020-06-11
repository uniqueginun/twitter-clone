<?php


namespace App\Media;

use Spatie\MediaLibrary\Models\Media as baseMedia;

class Media extends baseMedia
{
    public function type()
    {
        return MimeTypes::type($this->mime_type);
    }
}