<?php

namespace JamesDordoy\HTMLable\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HTMLable
{
    public function getHtmlableModel(): Model;
}
