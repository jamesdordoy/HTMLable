<?php

namespace JamesDordoy\HTMLable\Http\Controllers\Documents;

use JamesDordoy\HTMLable\Actions\Documents\Download;
use JamesDordoy\HTMLable\Models\Document;

class DownloadDocumentController
{
    public function __invoke(Document $document)
    {
        $path = app(Download::class)(document: $document);

        return response()->download(file: $path)->deleteFileAfterSend(true);
    }
}
