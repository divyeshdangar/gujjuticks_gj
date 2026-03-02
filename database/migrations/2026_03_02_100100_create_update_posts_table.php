<?php

use App\Models\UpdatePost;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('update_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('update_category_id')->constrained('update_categories');
            $table->foreignId('created_by')->constrained('users');
            $table->enum('type', [
                UpdatePost::TYPE_STATUS,
                UpdatePost::TYPE_IMAGE,
                UpdatePost::TYPE_YOUTUBE,
                UpdatePost::TYPE_POLL,
                UpdatePost::TYPE_QA,
            ])->default(UpdatePost::TYPE_STATUS);
            $table->enum('privacy', [UpdatePost::PRIVACY_PUBLIC, UpdatePost::PRIVACY_PRIVATE])->default(UpdatePost::PRIVACY_PUBLIC);
            $table->enum('status', [UpdatePost::STATUS_ACTIVE, UpdatePost::STATUS_DELETED, UpdatePost::STATUS_REPORTED])->default(UpdatePost::STATUS_ACTIVE);
            $table->string('image')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('external_link')->nullable();
            $table->string('poll_question')->nullable();
            $table->string('qa_question')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'privacy', 'city_id']);
            $table->index(['update_category_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('update_posts');
    }
};

