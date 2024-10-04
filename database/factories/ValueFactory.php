<?php

namespace JamesDordoy\HTMLable\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JamesDordoy\HTMLable\Models\Value;

class ValueFactory extends Factory
{
    protected $model = Value::class;

    public function definition()
    {
        return [
            // $table->foreignIdFor(Element::class)->onDelete('cascade');
            // $table->string('key');
            // $table->text('value')->nullable();
        ];
    }
}
