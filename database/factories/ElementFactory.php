<?php

namespace JamesDordoy\HTMLable\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JamesDordoy\HTMLable\Models\Element;

class ElementFactory extends Factory
{
    protected $model = Element::class;

    public function definition()
    {
        return [
            // $table->uuid()->unique();
            // $table->foreignIdFor(Document::class)->onDelete('cascade');
            // $table->foreignIdFor(Element::class, 'parent_id')->onDelete('cascade');
            // $table->string('tag');
        ];
    }
}
