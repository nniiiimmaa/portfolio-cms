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
        Schema::create('languages', function (Blueprint $table) {
        $table->id();
        $table->string('code', 5)
            ->unique();
        $table->string('name');
        $table->string('native_name');
        $table->enum('direction', [
            'ltr',
            'rtl',
        ])->default('ltr');
        $table->boolean('active')
            ->default(true);
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
        Schema::dropIfExists('languages');
    }
};
