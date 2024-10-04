<?php

namespace JamesDordoy\HTMLable\Actions\Elements;

use JamesDordoy\HTMLable\Models\Element;

class Delete
{
    public function __invoke(Element $element): Element
    {
        $element->delete();

        return $element;
    }
}
