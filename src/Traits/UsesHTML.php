<?php

namespace JamesDordoy\HTMLable\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JamesDordoy\HTMLable\Models\Document;

trait UsesHTML
{
    public function getHtmlableModel(): Model
    {
        return $this;
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
