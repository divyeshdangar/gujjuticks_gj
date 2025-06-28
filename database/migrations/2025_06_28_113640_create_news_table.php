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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->text('type')->nullable(); // news, youtube, article, blog
            $table->string('title');
            $table->string('slug')->unique()->nullable(); // for SEO-friendly URLs
            $table->text('content')->nullable();
            $table->text('link')->nullable();
            $table->foreignId('news_category_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('location')->nullable();
            $table->string('image')->nullable(); // news main image
            $table->text('meta_description')->nullable();
            $table->string('keywords')->nullable(); // comma-separated
            $table->boolean('is_featured')->default(false); // highlight on homepage etc.
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable(); // schedule support
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
