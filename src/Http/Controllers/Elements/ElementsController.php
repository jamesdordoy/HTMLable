<?php

namespace JamesDordoy\HTMLable\Http\Controllers\Elements;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JamesDordoy\HTMLable\Models\Element;

class ElementsController extends Controller
{
    public function index(Request $request)
    {
        return Element::all();
    }

    public function create(Request $request)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, Element $element)
    {
        return $element;
    }

    public function edit(Element $element)
    {
        //
    }

    public function update(Request $request, Element $element)
    {
        //
    }

    public function destroy(Element $element)
    {
        //
    }
}
