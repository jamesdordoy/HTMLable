<?php

namespace JamesDordoy\HTMLable\Renderer;

use Illuminate\Support\HtmlString;
use JamesDordoy\HTMLable\Contracts\RenderStrategy;
use JamesDordoy\HTMLable\Models\Element;
use JamesDordoy\HTMLable\Models\Value;

class DownloadRenderer implements RenderStrategy
{
    public function renderValue(Value $value): string
    {
        return $value->renderAttributesLocally();
    }

    public function renderChild(Element $child): HtmlString
    {
        return $child->renderForDownload();
    }
}
