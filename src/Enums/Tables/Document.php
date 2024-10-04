<?php

namespace JamesDordoy\HTMLable\Enums\Tables;

use Illuminate\Database\Schema\Blueprint;

enum Document: string
{
    case TABLE_NAME = 'documents';

    public static function toTable(Blueprint $table): callable
    {
        return function () use ($table) {
            $table->id();
            $table->morphs('model');
            $table->string('name')->unique();
            $table->text('doctype')->nullable();
            $table->timestamps();
        };
    }
}
