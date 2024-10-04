<?php

namespace JamesDordoy\HTMLable\Rules\Documents;

class CreateElement
{
    public function __invoke(array $additionalRules = []): array
    {
        return [
            ...$additionalRules,
            'tag' => 'required',
            'uuid' => 'required',
            'document_id' => 'required|nullable',
            'parent_id' => 'required|nullable',
        ];
    }
}