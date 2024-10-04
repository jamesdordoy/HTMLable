<?php

namespace JamesDordoy\HTMLable\Http\Resources\Documents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $document = $this->resource;

        return [
            ...parent::toArray($request),
            'rendered' => (string) $document->render(),
            'elements' => $this->elements,
        ];
    }
}
