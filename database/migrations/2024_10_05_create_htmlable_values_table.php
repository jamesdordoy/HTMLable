<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use JamesDordoy\HTMLable\Enums\Tables\Value;

return new class extends Migration
{
    public function up()
    {
        Schema::create(Value::TABLE_NAME->value, function (Blueprint $table) {
            $table->id();
            $table->foreignId('element_id')->nullable()->constrained('elements')->onDelete('cascade');
            $table->string('key');
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }
};
