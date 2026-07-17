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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_type_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->foreignId('project_status_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('title');
            $table->string('slug')
                ->unique();
            $table->text('description');
            $table->string('logo')
                ->nullable();
            $table->string('github_url')
                ->nullable();
            $table->string('live_url')
                ->nullable();
            $table->boolean('featured')
                ->default(false);
            $table->unsignedInteger('order')
                ->default(0);
            $table->json('technologies')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
