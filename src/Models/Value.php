<?php

namespace JamesDordoy\HTMLable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Value extends Model
{
    protected $guarded = ['id'];

    public function element(): BelongsTo
    {
        return $this->belongsTo(Element::class);
    }

    public function render(): string
    {
        return "{$this->key}=\"{$this->value}\"";
    }

    public function renderAttributesLocally(): string
    {
        if ($this->key == 'src') {

            $path = Str::of(parse_url($this->value, PHP_URL_PATH));
            $segments = collect(explode('/', $path));
            $media = Media::find($segments->get(3));

            return "{$this->key}=\"./assets/{$media->file_name}\"";
        }

        return "{$this->key}=\"{$this->value}\"";
    }
}
