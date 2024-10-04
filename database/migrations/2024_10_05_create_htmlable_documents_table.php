<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JamesDordoy\HTMLable\Enums\Tables\Document;

return new class extends Migration
{
    public function up()
    {
        Schema::create(Document::TABLE_NAME->value, function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->string('name')->unique();
            $table->text('doctype')->nullable();
            $table->timestamps();
        });
    }
};
