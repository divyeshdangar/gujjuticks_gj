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
        Schema::table('menus', function (Blueprint $table) {
            $table->enum('type', ['0', '1', '2', '3'])->default('0'); // 1: other, 2: sidebar, 3: header
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->enum('lang', ['e', 'g', 'h'])->default('e'); // e: english, h: hindi, g: gujarati
            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('blogs');
            $table->enum('status', ['1', '0'])->default('1');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function($table) {
            $table->dropColumn('type');
        });
        Schema::table('blogs', function($table) {
            $table->dropColumn('lang');
            $table->dropColumn('parent_id');
            $table->dropColumn('status');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
        Schema::table('locations', function($table) {
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
};
