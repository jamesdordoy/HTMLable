<?php

namespace JamesDordoy\HTMLable\Actions\Documents;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use JamesDordoy\HTMLable\Models\Document;
use JamesDordoy\HTMLable\Rules\Documents\CreateDocument;
use Illuminate\Validation\ValidationException;

class Create
{
    public function __invoke(Model $model, string $name, string $doctype, bool $validate = true): Document
    {
        $data = [
            'model_id' => $model->id,
            'model_type' => get_class($model),
            'name' => $name,
            'doctype' => $doctype,
        ];

        $data = $validate ? $this->validate($data) : $data;

        return Document::create($data);
    }

    protected function validate(array $data): array
    {
        $validator = Validator::make($data, app(CreateDocument::class)());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
