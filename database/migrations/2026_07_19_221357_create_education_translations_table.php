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
        Schema::create('education_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('language_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('institution');
            $table->string('degree');
            $table->string('field')
                ->nullable();
            $table->string('location')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->timestamps();
            $table->unique([
                'education_id',
                'language_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_translations');
    }
};
