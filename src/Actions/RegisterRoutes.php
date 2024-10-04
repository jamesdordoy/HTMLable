<?php

namespace JamesDordoy\HTMLable\Actions;

use Illuminate\Support\Facades\Route;
use JamesDordoy\HTMLable\Http\Controllers\Documents\DocumentsController;
use JamesDordoy\HTMLable\Http\Controllers\Documents\DownloadDocumentController;
use JamesDordoy\HTMLable\Http\Controllers\Documents\RenderDocumentController;
use JamesDordoy\HTMLable\Http\Controllers\Elements\ElementsController;
use JamesDordoy\HTMLable\Http\Controllers\Elements\RenderElementController;
use JamesDordoy\HTMLable\Http\Controllers\Media\ServeMediaController;
use JamesDordoy\HTMLable\Http\Controllers\Values\ValuesController;

class RegisterRoutes
{
    public function __invoke()
    {
        Route::resource('/htmlable/documents', DocumentsController::class);
        Route::get('/htmlable/documents/{document}/render', RenderDocumentController::class);
        Route::get('/htmlable/documents/{document}/download', DownloadDocumentController::class);

        Route::resource('/htmlable/elements', ElementsController::class);
        Route::get('/htmlable/elements/{element}/render', RenderElementController::class);

        Route::resource('/htmlable/values', ValuesController::class);

        Route::get('/htmlable/media/{media}/serve-signed', ServeMediaController::class)
            ->middleware(['signed'])
            ->name('htmlable.media.serve-signed');

        Route::get('/htmlable/media/{media}/serve', ServeMediaController::class);
    }
}
