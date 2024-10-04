<?php

namespace JamesDordoy\HTMLable\Http\Controllers\Documents;

use Illuminate\Support\HtmlString;
use JamesDordoy\HTMLable\Models\Document;

class RenderDocumentPDFController
{
    public function __invoke(Document $document)
    {
        return $document->render();
    }
}
