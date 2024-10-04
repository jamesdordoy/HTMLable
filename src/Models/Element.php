<?php

namespace JamesDordoy\HTMLable\Models;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\HtmlString;
use JamesDordoy\HTMLable\Contracts\RenderStrategy;
use JamesDordoy\HTMLable\Enums\HtmlElement;
use JamesDordoy\HTMLable\Renderer\HTMLRenderer;
use JamesDordoy\HTMLable\Renderer\DownloadRenderer;

class Element extends Model implements Renderable
{
    protected $guarded = ['id'];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Element::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Element::class, 'parent_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }

    // Strategy Pattern for rendering
    public function render(): HtmlString
    {
        return $this->baseRender(new HTMLRenderer());
    }

    public function renderForDownload(): HtmlString
    {
        return $this->baseRender(new DownloadRenderer());
    }

    private function baseRender(RenderStrategy $strategy): HtmlString
    {
        $tag = $this->tag;
        $attributes = $this->values->map(fn (Value $value) => $strategy->renderValue($value))->implode(' ');
        $contentValue = $this->values->firstWhere('key', 'innard')->value ?? '';

        $childrenHtml = '';
        foreach ($this->children as $child) {
            $childrenHtml .= $strategy->renderChild($child);
        }

        $html = $contentValue . $childrenHtml;

        if (in_array($tag, HtmlElement::getSelfClosingElements())) {
            return new HtmlString("<{$tag} data-id='{$this->uuid}' {$attributes} />");
        }

        return new HtmlString("<{$tag} data-id='{$this->uuid}' {$attributes}>{$html}</{$tag}>");
    }
}