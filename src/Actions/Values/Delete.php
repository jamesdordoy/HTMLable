<?php

namespace JamesDordoy\HTMLable\Actions\Values;

use JamesDordoy\HTMLable\Models\Value;

class Delete
{
    public function __invoke(Value $value): Value
    {
        $value->delete();

        return $value;
    }
}
