<?php

namespace JamesDordoy\HTMLable\Actions\Documents;

use JamesDordoy\HTMLable\Models\Document;

class Delete
{
    public function __invoke(Document $document): Document
    {
        $document->delete();

        return $document;
    }
}
