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
        Schema::table('place_categories', function (Blueprint $table) {
            $table->string('keywords',1024)->nullable();
            $table->integer('home_order')->default();
            $table->text('description')->nullable();
            $table->text('meta_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('place_categories', function($table) {
            $table->dropColun('keywords');
            $table->dropColun('home_order');
            $table->dropColun('description');
            $table->dropColun('meta_description');
        });
    }
};
