<?php

namespace JamesDordoy\HTMLable\Facades;

use Illuminate\Support\Facades\Facade;

class HTMLable extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \JamesDordoy\HTMLable\HTMLable::class;
    }
}
