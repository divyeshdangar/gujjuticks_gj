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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
            $table->string('image')->nullable()->default('default.png');
            $table->foreignId('parent_id')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->text('meta_description')->nullable();
            $table->foreign('parent_id')->references('id')->on('blog_categories');
            $table->timestamps();
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('blog_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
        Schema::table('blogs', function($table) {
            $table->dropColumn('category_id');
        });
    }
};
