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
        Schema::create('template_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->nullable();
            $table->string('link')->index();
            $table->json('data')->nullable();
            $table->foreign('template_id')->references('id')->on('template');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('template', function (Blueprint $table) {
            $table->enum('type', ['1', '2'])->default('1')->comment('1 = link page, 2 = wish page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_data');

        Schema::table('template', function($table) {
            $table->dropColun('type');
        }); 
    }
};
