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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issuer_name');
            $table->string('issuer_country')
                ->nullable();
            $table->date('issue_date');
            $table->date('expiration_date')
                ->nullable();
            $table->string('credential_id')
                ->nullable();
            $table->string('credential_url')
                ->nullable();
            $table->string('image')
                ->nullable();
            $table->text('description')
                ->nullable();
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
        Schema::dropIfExists('certifications');
    }
};
