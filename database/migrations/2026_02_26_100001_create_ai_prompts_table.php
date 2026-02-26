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
        Schema::create('ai_prompts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_prompt_category_id')->constrained()->onDelete('cascade');
            $table->string('unique_id', 64)->unique()->comment('Public unique identifier for the prompt');
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('prompt');
            $table->string('prompt_version', 32)->default('1.0');
            $table->unsignedInteger('copy_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_prompts');
    }
};
