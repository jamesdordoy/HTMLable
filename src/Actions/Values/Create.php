<?php

namespace JamesDordoy\HTMLable\Actions\Values;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JamesDordoy\HTMLable\Models\Element;
use JamesDordoy\HTMLable\Models\Value;

class Create
{
    public function __invoke(string $key, string $value, Element $element, bool $validate = true): Value
    {
        $data = [
            'key' => $key,
            'value' => $value,
            'element_id' => $element->id,
        ];

        $data = $validate ? $this->validate($data) : $data;

        return Value::create($data);
    }

    protected function validate(array $data): array
    {
        $validator = Validator::make($data, [
            'key' => 'required',
            'value' => 'required|nullable',
            'element_id' => 'required',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
