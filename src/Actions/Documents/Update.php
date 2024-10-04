<?php

namespace JamesDordoy\HTMLable\Actions\Documents;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JamesDordoy\HTMLable\Models\Document;

class Update
{
    public function __invoke(Document $document, string $name, string $doctype, bool $validate = true): Document
    {
        $data = [
            'name' => $name,
            'doctype' => $doctype,
        ];

        if ($validate) {
            $data = $this->validate($data);
        }

        $document->update($data);

        return $document;
    }

    protected function validate(array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'doctype' => 'required|nullable',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
