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
        Schema::create('contact_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('language_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->text('description')
                ->nullable();
            $table->string('address')
                ->nullable();
            $table->string('city')
                ->nullable();
            $table->string('state')
                ->nullable();
            $table->string('country')
                ->nullable();
            $table->string('postal_code')
                ->nullable();
            $table->string('working_hours')
                ->nullable();
            $table->timestamps();
            $table->unique([
                'contact_id',
                'language_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_translations');
    }
};
