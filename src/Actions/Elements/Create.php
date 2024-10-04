<?php

namespace JamesDordoy\HTMLable\Actions\Elements;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JamesDordoy\HTMLable\Models\Document;
use JamesDordoy\HTMLable\Models\Element;
use JamesDordoy\HTMLable\Rules\Documents\CreateElement;

class Create
{
    public function __invoke(string $tag, Document $document, ?Element $parent = null, bool $validate = true): Element
    {
        $data = [
            'tag' => $tag,
            'uuid' => '',
            'document_id' => $document->id,
            'parent_id' => is_null($parent) ? null : $parent->id,
        ];

        $data = ($validate ?? $this->validate($data));

        return Element::create($data);
    }

    protected function validate(array $data): array
    {
        $validator = Validator::make($data, app(CreateElement::class)());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
