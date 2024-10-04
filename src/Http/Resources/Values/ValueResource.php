<?php

namespace JamesDordoy\HTMLable\Http\Resources\Values;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ValueResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
        ];
    }
}
