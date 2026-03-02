<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('update_poll_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('update_post_id')->constrained('update_posts')->onDelete('cascade');
            $table->string('option_text');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->unsignedInteger('votes_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('update_poll_options');
    }
};

