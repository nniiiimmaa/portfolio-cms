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
        Schema::create('about_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_id')
                ->constrained('abouts')
                ->cascadeOnDelete();
            $table->string('locale', 5);
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->string('availability_text')
                ->nullable();
            $table->timestamps();
            $table->unique([
                'about_id',
                'locale',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_translations');
    }
};
