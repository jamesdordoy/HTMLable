<?php

namespace JamesDordoy\HTMLable\Renderer;

use Illuminate\Support\HtmlString;
use JamesDordoy\HTMLable\Contracts\RenderStrategy;
use JamesDordoy\HTMLable\Models\Value;
use JamesDordoy\HTMLable\Models\Element;

class HTMLRenderer implements RenderStrategy
{
    public function renderValue(Value $value): string
    {
        return $value->render();
    }

    public function renderChild(Element $child): HtmlString
    {
        return $child->render();
    }
}
