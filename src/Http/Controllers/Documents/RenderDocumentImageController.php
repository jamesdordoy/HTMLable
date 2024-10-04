<?php

namespace JamesDordoy\HTMLable\Http\Controllers\Documents;

use Illuminate\Support\HtmlString;
use JamesDordoy\HTMLable\Models\Document;

class RenderDocumentImageController
{
    public function __invoke(Document $document): HtmlString
    {
        return $document->render();
    }
}
