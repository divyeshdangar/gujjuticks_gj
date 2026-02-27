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
        Schema::table('ai_prompt_categories', function (Blueprint $table) {
            $table->string('image')->nullable()->after('description');
            $table->text('meta_description')->nullable()->after('image');
            $table->string('meta_keywords')->nullable()->after('meta_description');
        });

        Schema::table('ai_prompts', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('unique_id');
            $table->string('image')->nullable()->after('description');
            $table->text('meta_description')->nullable()->after('image');
            $table->string('meta_keywords')->nullable()->after('meta_description');
        });

        // Populate slug from unique_id for existing rows
        foreach (\DB::table('ai_prompts')->orderBy('id')->get() as $row) {
            \DB::table('ai_prompts')->where('id', $row->id)->update([
                'slug' => \Str::slug($row->unique_id ?? 'prompt-' . $row->id),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_prompt_categories', function (Blueprint $table) {
            $table->dropColumn(['image', 'meta_description', 'meta_keywords']);
        });

        Schema::table('ai_prompts', function (Blueprint $table) {
            $table->dropColumn(['slug', 'image', 'meta_description', 'meta_keywords']);
        });
    }
};
