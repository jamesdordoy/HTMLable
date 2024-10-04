<?php

namespace JamesDordoy\HTMLable\Contracts;

use Illuminate\Support\HtmlString;
use JamesDordoy\HTMLable\Models\Element;
use JamesDordoy\HTMLable\Models\Value;

interface RenderStrategy
{
    public function renderValue(Value $value): string;
    public function renderChild(Element $child): HtmlString;
}
