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
        Schema::table('locations', function (Blueprint $table) {
            $table->enum('status', ['1', '0'])->default('1');
            $table->string('image')->nullable()->default('default.png');
            $table->text('meta_description')->nullable();
            $table->text('slug')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function($table) {
            $table->dropColumn('status');
            $table->dropColumn('image');
            $table->dropColumn('meta_description');
            $table->dropColumn('slug');
            $table->dropColumn('code');
            $table->dropColumn('meta_keywords');
        });
    }
};
