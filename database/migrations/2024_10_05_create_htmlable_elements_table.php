<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JamesDordoy\HTMLable\Enums\Tables\Element;

return new class extends Migration
{
    public function up()
    {
        Schema::create(Element::TABLE_NAME->value, function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('document_id')->nullable()->constrained('documents')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('elements')->onDelete('cascade');
            $table->string('tag');
            $table->timestamps();
        });
    }
};
