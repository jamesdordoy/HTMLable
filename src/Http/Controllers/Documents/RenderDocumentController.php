<?php

namespace JamesDordoy\HTMLable\Http\Controllers\Documents;

use Illuminate\Support\HtmlString;
use JamesDordoy\HTMLable\Models\Document;

class RenderDocumentController
{
    public function __invoke(Document $document): HtmlString
    {
        return $document->render();
    }
}
