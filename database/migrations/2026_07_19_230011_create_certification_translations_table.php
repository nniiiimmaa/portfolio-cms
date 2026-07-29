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
        Schema::create('certification_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certification_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('language_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('title');
            $table->string('issuer_name');
            $table->string('issuer_country')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->timestamps();
            $table->unique([
                'certification_id',
                'language_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certification_translations');
    }
};
