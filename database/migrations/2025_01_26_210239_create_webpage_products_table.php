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
        Schema::table('webpage_links', function (Blueprint $table) {
            $table->integer('order')->default('0');
        });

        Schema::create('webpage_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('template_id')->nullable();
            $table->foreignId('webpage_id')->nullable();
            $table->string('type');
            $table->string('title');
            $table->string('link')->index();
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
        Schema::table('webpage_links', function($table) {
            $table->dropColumn('order');
        });

        Schema::dropIfExists('webpage_products');
    }
};
