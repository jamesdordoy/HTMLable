<?php

namespace JamesDordoy\HTMLable\Http\Controllers\Media;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ServeMediaController extends Controller
{
    public function __invoke(Request $request, Media $media): StreamedResponse
    {
        return $media->toInlineResponse($request);
    }
}
