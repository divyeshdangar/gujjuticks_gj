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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->uuid('token')->unique(); // for public access
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('website')->nullable();
            $table->string('designation')->nullable();
            $table->text('about')->nullable();
            $table->string('image')->nullable(); // profile photo URL/path
            $table->text('links')->nullable(); // comma-separated social links
            $table->string('language')->nullable(); // e.g. 'en', 'hi'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
