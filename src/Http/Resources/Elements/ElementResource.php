<?php

namespace JamesDordoy\HTMLable\Http\Resources\Elements;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementResource extends JsonResource
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
