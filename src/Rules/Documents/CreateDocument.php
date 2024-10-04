<?php

namespace JamesDordoy\HTMLable\Rules\Documents;

class CreateDocument
{
    public function __invoke(array $additionalRules = []): array
    {
        return [
            ...$additionalRules,
            'model_id' => ['required'],
            'model_type' => ['required'],
            'name' => ['required', 'unique:documents,name'],
            'doctype' => ['required', 'nullable'],
        ];
    }
}
