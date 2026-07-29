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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')
                ->nullable();
            $table->string('subject')
                ->nullable();
            $table->longText('message');
            $table->string('ip_address', 45)
                ->nullable();
            $table->text('user_agent')
                ->nullable();
            $table->string('referrer')
                ->nullable();
            $table->enum('status', [
                'new',
                'read',
                'replied',
                'archived',
            ])->default('new');
            $table->timestamp('read_at')
                ->nullable();
            $table->timestamp('replied_at')
                ->nullable();
            $table->timestamps();
            $table->index('status');
            $table->index('email');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
