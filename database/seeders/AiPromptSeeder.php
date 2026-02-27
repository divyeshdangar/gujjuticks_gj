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
                'image' => null,
                'meta_description' => 'Browse AI prompts for writing and content creation. Blog outlines, simplification, and creative writing.',
                'meta_keywords' => 'AI writing prompts, blog prompts, content writing, creative writing',
                'sort_order' => 1,
            ],
            [
                'name' => 'Marketing & SEO',
                'slug' => 'marketing-seo',
                'description' => 'Prompts for copywriting, ads, and search optimization.',
                'image' => null,
                'meta_description' => 'AI prompts for marketing and SEO. Social media, meta descriptions, and copywriting.',
                'meta_keywords' => 'marketing prompts, SEO prompts, social media, copywriting',
                'sort_order' => 2,
            ],
            [
                'name' => 'Code & Technical',
                'slug' => 'code-technical',
                'description' => 'Prompts for coding, debugging, and documentation.',
                'image' => null,
                'meta_description' => 'Technical AI prompts for developers. Code explanation, PHP, and documentation.',
                'meta_keywords' => 'code prompts, developer prompts, PHP, technical writing',
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
                'slug' => 'gt-wr-001-blog-post-outline-generator',
                'title' => 'Blog post outline generator',
                'description' => 'Generate a structured outline for a blog post with intro, sections, and CTA.',
                'image' => null,
                'meta_description' => 'Free AI prompt to generate a detailed blog post outline with hook, sections, and CTA. Use for any topic.',
                'meta_keywords' => 'blog outline, content outline, AI writing, blog structure',
                'prompt' => "Create a detailed blog post outline for the topic: [TOPIC]. Include: 1) A hook for the introduction, 2) 3-5 main sections with sub-points, 3) Key takeaways or bullet list, 4) A strong call-to-action. Keep each section concise and actionable.",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $writingId,
                'unique_id' => 'GT-WR-002',
                'slug' => 'gt-wr-002-simplify-complex-text',
                'title' => 'Simplify complex text',
                'description' => 'Rewrite technical or complex content in simple language.',
                'image' => null,
                'meta_description' => 'AI prompt to rewrite complex or technical text in simple language for general audience.',
                'meta_keywords' => 'simplify text, plain language, rewrite, readability',
                'prompt' => "Rewrite the following text in simple, easy-to-understand language. Keep the main ideas and facts but use everyday words and short sentences. Target audience: general public.\n\n[PASTE YOUR TEXT HERE]",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $marketingId,
                'unique_id' => 'GT-MK-001',
                'slug' => 'gt-mk-001-social-media-post-ideas',
                'title' => 'Social media post ideas',
                'description' => 'Generate multiple post ideas for a product or brand.',
                'image' => null,
                'meta_description' => 'Generate 5 social media post ideas with platform, type, caption and hashtags. For any product or brand.',
                'meta_keywords' => 'social media ideas, content ideas, Instagram, LinkedIn, hashtags',
                'prompt' => "Generate 5 engaging social media post ideas for: [PRODUCT/BRAND/SERVICE]. For each idea include: platform (e.g. Instagram, LinkedIn), post type (carousel, story, reel), headline, 1-2 sentence caption, and 3 relevant hashtags. Tone: [FRIENDLY/PROFESSIONAL/CASUAL].",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $marketingId,
                'unique_id' => 'GT-MK-002',
                'slug' => 'gt-mk-002-meta-description-seo',
                'title' => 'Meta description for SEO',
                'description' => 'Write a meta description under 160 characters for a page.',
                'image' => null,
                'meta_description' => 'AI prompt to write SEO meta descriptions under 155 characters. Includes CTA and keywords.',
                'meta_keywords' => 'meta description, SEO, snippet, search result',
                'prompt' => "Write a compelling meta description (max 155 characters) for a page with the following title and main focus:\nTitle: [PAGE TITLE]\nFocus: [KEY THEME/KEYWORDS]\nInclude a clear benefit or CTA. No quotation marks in the output.",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $codeId,
                'unique_id' => 'GT-CD-001',
                'slug' => 'gt-cd-001-explain-code-plain-english',
                'title' => 'Explain code in plain English',
                'description' => 'Get a short explanation of what a code snippet does.',
                'image' => null,
                'meta_description' => 'Paste code and get a short plain-English explanation. Perfect for documentation and learning.',
                'meta_keywords' => 'explain code, code documentation, plain English',
                'prompt' => "Explain what the following code does in 2-4 short sentences. Use plain English, avoid jargon where possible.\n\n```\n[PASTE CODE HERE]\n```",
                'prompt_version' => '1.0',
            ],
            [
                'ai_prompt_category_id' => $codeId,
                'unique_id' => 'GT-CD-002',
                'slug' => 'gt-cd-002-php-function-from-description',
                'title' => 'PHP function from description',
                'description' => 'Generate a PHP function based on a short description.',
                'image' => null,
                'meta_description' => 'Describe what you need and get a PHP function with type hints and docblock. Modern PHP 7.4+.',
                'meta_keywords' => 'PHP, function generator, code generator, Laravel',
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
