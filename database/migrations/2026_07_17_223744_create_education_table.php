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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
                $table->string('institution');
            $table->string('degree');
            $table->string('field')
                ->nullable();
            $table->string('location')
                ->nullable();
            $table->date('start_date');
            $table->date('end_date')
                ->nullable();
            $table->decimal('score', 4, 2)
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->string('logo')
                ->nullable();
            $table->boolean('current')
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
        Schema::dropIfExists('education');
    }
};
