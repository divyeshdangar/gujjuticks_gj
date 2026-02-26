<?php

namespace Database\Seeders;

use App\Models\AiPrompt;
use App\Models\AiPromptCategory;
use Illuminate\Database\Seeder;

class AiPromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Writing & Content',
                'slug' => 'writing-content',
                'description' => 'Prompts for articles, blogs, and creative writing.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Marketing & SEO',
                'slug' => 'marketing-seo',
                'description' => 'Prompts for copywriting, ads, and search optimization.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Code & Technical',
                'slug' => 'code-technical',
                'description' => 'Prompts for coding, debugging, and documentation.',
                'sort_order' => 3,
            ],
        ];

        foreach ($categories as $cat) {
            AiPromptCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                array_merge($cat, ['is_active' => true])
            );
        }

        $writingId = AiPromptCategory::where('slug', 'writing-content')->first()->id;
        $marketingId = AiPromptCategory::where('slug', 'marketing-seo')->first()->id;
        $codeId = AiPromptCategory::where('slug', 'code-technical')->first()->id;

        $prompts = [
            [
                'ai_prompt_category_id' => $writingId,
                'unique_id' => 'GT-WR-001',
                'title' => 'Blog post outline generator',
                'description' => 'Generate a structured outline for a blog post with intro, sections, and CTA.',
                'prompt' => "Create a detailed blog post outline for the topic: [TOPIC]. Include: 1) A hook for the introduction, 2) 3-5 main sections with sub-points, 3) Key takeaways or bullet list, 4) A strong call-to-action. Keep each section concise and actionable.",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $writingId,
                'unique_id' => 'GT-WR-002',
                'title' => 'Simplify complex text',
                'description' => 'Rewrite technical or complex content in simple language.',
                'prompt' => "Rewrite the following text in simple, easy-to-understand language. Keep the main ideas and facts but use everyday words and short sentences. Target audience: general public.\n\n[PASTE YOUR TEXT HERE]",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $marketingId,
                'unique_id' => 'GT-MK-001',
                'title' => 'Social media post ideas',
                'description' => 'Generate multiple post ideas for a product or brand.',
                'prompt' => "Generate 5 engaging social media post ideas for: [PRODUCT/BRAND/SERVICE]. For each idea include: platform (e.g. Instagram, LinkedIn), post type (carousel, story, reel), headline, 1-2 sentence caption, and 3 relevant hashtags. Tone: [FRIENDLY/PROFESSIONAL/CASUAL].",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $marketingId,
                'unique_id' => 'GT-MK-002',
                'title' => 'Meta description for SEO',
                'description' => 'Write a meta description under 160 characters for a page.',
                'prompt' => "Write a compelling meta description (max 155 characters) for a page with the following title and main focus:\nTitle: [PAGE TITLE]\nFocus: [KEY THEME/KEYWORDS]\nInclude a clear benefit or CTA. No quotation marks in the output.",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $codeId,
                'unique_id' => 'GT-CD-001',
                'title' => 'Explain code in plain English',
                'description' => 'Get a short explanation of what a code snippet does.',
                'prompt' => "Explain what the following code does in 2-4 short sentences. Use plain English, avoid jargon where possible.\n\n```\n[PASTE CODE HERE]\n```",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $codeId,
                'unique_id' => 'GT-CD-002',
                'title' => 'PHP function from description',
                'description' => 'Generate a PHP function based on a short description.',
                'prompt' => "Write a PHP function that: [DESCRIPTION]. Use type hints and a short docblock. Prefer modern PHP (7.4+). Handle edge cases and return a sensible default if needed. Only output the function code, no extra explanation.",
                'prompt_version' => '1.0',
            ],
        ];

        foreach ($prompts as $p) {
            AiPrompt::updateOrCreate(
                ['unique_id' => $p['unique_id']],
                array_merge($p, ['copy_count' => 0, 'is_active' => true])
            );
        }
    }
}
