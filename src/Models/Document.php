<?php

namespace JamesDordoy\HTMLable\Models;

use DOMDocument;
use DOMElement;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use JamesDordoy\HTMLable\Enums\HtmlElement;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Document extends Model implements HasMedia, Renderable
{
    use InteractsWithMedia;

    protected $guarded = ['id'];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function elements(): HasMany
    {
        return $this->hasMany(Element::class);
    }

    public function render(bool $local = false): HtmlString
    {
        $rootElement = $this->getRootElement();
        $docType = $this->getDocType();

        if (is_null($rootElement)) {
            throw new Exception('No root html element. Please import your HTML document / assets');
        }

        return new HtmlString("{$docType}{$rootElement->render()}");
    }

    public function renderWithLocalPaths()
    {
        $rootElement = $this->getRootElement();
        $docType = $this->getDocType();

        if (is_null($rootElement)) {
            throw new Exception('No root html element. Please import your HTML document / assets');
        }

        return new HtmlString("{$docType}{$rootElement->renderForDownload()}");
    }

    public function parse(HtmlString|string $html)
    {
        if (! is_null($this->getRootElement())) {
            throw new Exception('This document already has imported HTML elements.');
        }

        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($html, LIBXML_NOERROR | LIBXML_NOWARNING);
        libxml_clear_errors();

        $htmlElement = $dom->getElementsByTagName('html')->item(0);

        if (! $htmlElement) {
            throw new Exception('Cannot find root HTML element');
        }

        $this->saveElement($htmlElement);
    }

    protected function saveElement(DOMElement $node, $parentId = null)
    {
        $element = Element::create([
            'document_id' => $this->id,
            'tag' => $node->nodeName,
            'parent_id' => $parentId,
            'uuid' => Str::uuid(),
        ]);

        // Extract and create media asset and parse the value as a signed url.
        foreach ($node->attributes ?? [] as $attr) {
            if ($node->nodeName === 'img' && $attr->nodeName === 'src') {
                Value::create([
                    'element_id' => $element->id,
                    'key' => $attr->nodeName,
                    'value' => $this->getSignedPath($attr->nodeValue),
                ]);
            } else {
                Value::create([
                    'element_id' => $element->id,
                    'key' => $attr->nodeName,
                    'value' => $attr->nodeValue,
                ]);
            }
        }

        if (in_array($node->nodeName, HtmlElement::getSelfClosingElements())) {
            return;
        }

        if ($node->nodeName == "b") {
            dd($node->nodeValue);
        }

        // Check for <style> tags specifically
        if ($node->nodeName === 'style') {
            // Save the content of the <style> tag
            Value::create([
                'element_id' => $element->id,
                'key' => 'innard',
                'value' => trim($node->nodeValue),
            ]);
        } else {
            // Process child nodes
            foreach ($node->childNodes as $childNode) {
                // If the child node is a text node, save its content
                if ($childNode->nodeType === XML_TEXT_NODE) {
                    if (! empty(trim($childNode->nodeValue))) {
                        Value::create([
                            'element_id' => $element->id,
                            'key' => 'innard',
                            'value' => trim($childNode->nodeValue),
                        ]);
                    }
                } elseif ($childNode->nodeType === XML_ELEMENT_NODE) {
                    // Recursively process child elements
                    $this->saveElement($childNode, $element->id);
                }
            }
        }
    }

    protected function getSignedPath(string $source): string
    {
        $media = Media::where('name', pathinfo($source, PATHINFO_FILENAME))->first();

        return URL::signedRoute('htmlable.media.serve-signed', ['media' => $media->id]);
    }

    private function getRootElement()
    {
        return $this->elements()->whereNull('parent_id')->first();
    }

    private function getDocType(): string
    {
        return $this->doctype ?? '<!DOCTYPE>';
    }
}
