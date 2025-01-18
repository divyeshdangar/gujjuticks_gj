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
        Schema::table('webpages', function (Blueprint $table) {
            $table->enum('is_verified', ['0', '1'])->default('0');
        });

        Schema::table('template', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable();
            $table->string('slug')->index();
            $table->text('meta_description')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('webpage_link_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('webpage_id')->nullable();
            $table->foreignId('webpage_link_id')->nullable();
            $table->enum('type', ['1', '2'])->default('1'); // 1. link profile, 2. link page link
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('referrer_url')->nullable();
            //$table->timestamp('clicked_at')->useCurrent();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('webpage_id')->references('id')->on('webpages');
            $table->foreign('webpage_link_id')->references('id')->on('webpage_links');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('webpages', function($table) {
            $table->dropColumn('is_verified');
        });

        Schema::table('webpages', function($table) {
            $table->dropColun('user_id');
            $table->dropColun('slug');
            $table->dropColun('meta_description');
        });

        Schema::dropIfExists('webpage_link_clicks');
    }
};
