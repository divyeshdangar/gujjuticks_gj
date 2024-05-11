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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
            $table->foreignId('user_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('work_items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->index();
            $table->foreignId('board_id')->nullable();
            $table->foreignId('reporter_id')->nullable();
            $table->foreignId('assignee_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('board_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('work_item_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('board_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });

        Schema::create('work_item_histories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('board_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('user2_id')->nullable();
            $table->foreignId('work_item_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('work_item_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('board_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('work_item_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });



        // Foreign key references

        Schema::table('boards', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('work_items', function (Blueprint $table) {
            $table->foreign('reporter_id')->references('id')->on('users');
            $table->foreign('assignee_id')->references('id')->on('users');
            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('category_id')->references('id')->on('work_item_categories');
        });

        Schema::table('board_users', function (Blueprint $table) {
            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('work_item_categories', function (Blueprint $table) {
            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('work_item_histories', function (Blueprint $table) {
            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user2_id')->references('id')->on('users');
            $table->foreign('work_item_id')->references('id')->on('work_items');
        });

        Schema::table('work_item_comments', function (Blueprint $table) {
            $table->foreign('board_id')->references('id')->on('boards');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('work_item_id')->references('id')->on('work_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
        Schema::dropIfExists('work_items');
        Schema::dropIfExists('board_users');
        Schema::dropIfExists('work_item_categories');
        Schema::dropIfExists('work_item_histories');
        Schema::dropIfExists('work_item_comments');
    }
};
