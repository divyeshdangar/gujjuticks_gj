<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('update_poll_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('update_post_id')->constrained('update_posts')->onDelete('cascade');
            $table->foreignId('update_poll_option_id')->constrained('update_poll_options')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['update_post_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('update_poll_votes');
    }
};

