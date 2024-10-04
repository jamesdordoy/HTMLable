<?php

namespace JamesDordoy\HTMLable\Rules\Documents;

class CreateElement
{
    public function __invoke(array $additionalRules = []): array
    {
        return [
            ...$additionalRules,
            'key' => 'required',
            'value' => 'required|nullable',
            'element_id' => 'required',
        ];
    }
}
