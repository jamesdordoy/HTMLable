<?php

namespace JamesDordoy\HTMLable\Http\Controllers\Documents;

use Illuminate\Http\Request;
use JamesDordoy\HTMLable\Http\Requests\Documents\CreateDocumentRequest;
use JamesDordoy\HTMLable\Http\Resources\Documents\DocumentResource;
use JamesDordoy\HTMLable\Http\Resources\Documents\DocumentsResource;
use JamesDordoy\HTMLable\Models\Document;

class DocumentsController
{
    public function index(Request $request)
    {
        return new DocumentsResource(Document::get());
    }

    public function create(Request $request)
    {
        //
    }

    public function store(CreateDocumentRequest $request)
    {
        //
    }

    public function show(Document $document)
    {
        return new DocumentResource($document);
    }

    public function edit(Document $document)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        //
    }

    public function destroy(Document $document)
    {
        //
    }
}
