<?php

namespace JamesDordoy\HTMLable\Rules\Values;

class CreateValue
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
