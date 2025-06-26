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
        Schema::table('images', function (Blueprint $table) {
            $table->enum('type', ['color', 'image', 'random_color'])->default('color');
            $table->string('bg_color', 8)->default('#000000');
            $table->string('colors', 1024)->default('#000000');
            $table->string('image_title', 1024)->nullable();
            $table->string('image_alt', 1024)->nullable();
            $table->string('keywords', 1024)->nullable();
            $table->enum('generator', ['php', 'js'])->default('php');
            $table->softDeletes();
        });

        Schema::create('images_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('type', ['image', 'text', 'paragraph', 'random_text'])->default('text');
            $table->integer('list_order')->default(0);
            $table->string('random_identity', 256);
            $table->foreignId('image_id')->nullable();
            $table->foreign('image_id')->references('id')->on('images');
            $table->text('text')->nullable();
            $table->string('image')->nullable()->default('default.png');
            $table->string('form_title', 256)->nullable();
            $table->string('form_description', 1024)->nullable();
            $table->string('font', 256)->nullable();
            $table->integer('font_size')->default(25);
            $table->integer('height')->default(0);
            $table->integer('opacity')->default(0);
            $table->integer('width')->default(0);
            $table->integer('top')->default(0);
            $table->integer('left')->default(0);
            $table->integer('angle')->default(0);            
            $table->string('text_color', 8)->nullable();
            $table->string('text_color_multiline', 1024)->nullable();
            $table->enum('text_align', ['manual', 'center'])->default('manual');
            $table->enum('text_align_v', ['manual', 'center'])->default('manual');
            $table->enum('is_editable', ['1', '0'])->default('1');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function($table) {
            $table->dropColumn('user_type');
            $table->dropColumn('bg_color');
            $table->dropColumn('colors');
            $table->dropColumn('image_title');
            $table->dropColumn('image_alt');
            $table->dropColumn('keyword');
            $table->dropColumn('generator');
        });
        Schema::dropIfExists('images_data');
    }
};
