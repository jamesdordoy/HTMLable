<?php

namespace JamesDordoy\HTMLable\Http\Controllers\Elements;

use Illuminate\Routing\Controller;
use Illuminate\Support\HtmlString;

class RenderElementController extends Controller
{
    public function __invoke($element): HtmlString
    {
        return $element->render();
    }
}
