<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hobby_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hobby_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('image');
            $table->string('alt')
                ->nullable();
            $table->boolean('featured')
                ->default(false);
            $table->unsignedInteger('order')
                ->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hobby_images');
    }
};
