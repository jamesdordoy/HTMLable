<?php

namespace JamesDordoy\HTMLable\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JamesDordoy\HTMLable\Models\Document;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition()
    {
        return [
            // $table->morphs('model');
            // $table->string('name')->unique();
            // $table->text('doctype')->nullable();
        ];
    }
}
