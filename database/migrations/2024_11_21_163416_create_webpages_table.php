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
        Schema::create('industry_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image')->nullable()->default('default.png');
            $table->enum('status', ['1', '0'])->default('1');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('template', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable()->default('default.png');
            $table->enum('status', ['1', '0'])->default('1');
            $table->json('options')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('webpages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('template_id')->nullable();
            $table->foreignId('industry_type_id')->nullable();
            $table->string('title');
            $table->string('link')->index();
            $table->string('profile')->nullable()->default('default.png');
            $table->string('cover')->nullable()->default('default.png');
            $table->text('description')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->json('options')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('template_id')->references('id')->on('template');
            $table->foreign('industry_type_id')->references('id')->on('industry_types');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('webpage_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('template_id')->nullable();
            $table->foreignId('webpage_id')->nullable();
            $table->string('type');
            $table->string('title');
            $table->string('link')->index();
            $table->string('icon');
            $table->string('image')->nullable()->default('default.png');
            $table->json('options')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('template_id')->references('id')->on('template');
            $table->foreign('webpage_id')->references('id')->on('webpages');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webpage_links');
        Schema::dropIfExists('webpages');
        Schema::dropIfExists('template');
        Schema::dropIfExists('industry_types');
    }
};
