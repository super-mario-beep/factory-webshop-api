<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_modifiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('modifier_type');
            $table->decimal('value', 10, 2);
            $table->decimal('applies_over', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_modifiers');
    }
};