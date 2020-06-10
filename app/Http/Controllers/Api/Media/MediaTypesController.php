<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Media\MimeTypes;
use Illuminate\Http\Request;

class MediaTypesController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'images' => MimeTypes::$images,
                'video' => MimeTypes::$video
            ]
        ]);
    }
}
