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
        Schema::table('post_sets', function (Blueprint $table) {
            $table->string('topic')->nullable();
            $table->string('status')->default('created');    // pending, created, failed
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_sets', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('user_id');
            $table->dropColumn('topic');
        });
    }
};
