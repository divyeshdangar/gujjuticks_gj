<?php

namespace App\Console\Commands;

use App\Models\AiPrompt;
use App\Models\AiPromptCategory;
use App\Models\Blog;
use App\Models\BlogCategories;
use App\Models\City;
use App\Models\NewsCategory;
use App\Models\Pages;
use App\Models\PlaceCategory;
use App\Models\PostSet;
use App\Support\SitePages;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate public sitemaps and robots.txt for SEO';

    public function handle(): int
    {
        $this->writeMainSitemap();
        $this->writePostBuilderSitemap();
        $this->writeAiSitemap();
        $this->writeRobotsTxt();

        $this->info('Sitemaps and robots.txt updated in /public');

        return self::SUCCESS;
    }

    private function writeMainSitemap(): void
    {
        $sitemap = Sitemap::create();

        $static = [
            ['route' => 'home', 'priority' => 1.0, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['route' => 'form.contact', 'priority' => 0.9, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['route' => 'pages.services', 'priority' => 0.9, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['route' => 'pages.technology', 'priority' => 0.9, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['route' => 'pages.work', 'priority' => 0.9, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['route' => 'pages.about', 'priority' => 0.8, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['route' => 'pages.how-we-work', 'priority' => 0.8, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['route' => 'pages.industries', 'priority' => 0.8, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['route' => 'pages.faq', 'priority' => 0.7, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['route' => 'pages.careers', 'priority' => 0.7, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['route' => 'pages.blog.list', 'priority' => 0.8, 'freq' => Url::CHANGE_FREQUENCY_DAILY],
            ['route' => 'pages.news.list', 'priority' => 0.7, 'freq' => Url::CHANGE_FREQUENCY_DAILY],
            ['route' => 'pages.cities.list', 'priority' => 0.7, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['route' => 'pages.business', 'priority' => 0.6, 'freq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['route' => 'pages.postset.list', 'priority' => 0.6, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['route' => 'pages.ai_prompts.list', 'priority' => 0.6, 'freq' => Url::CHANGE_FREQUENCY_WEEKLY],
        ];

        foreach ($static as $item) {
            $sitemap->add(
                Url::create(route($item['route']))
                    ->setChangeFrequency($item['freq'])
                    ->setPriority($item['priority'])
            );
        }

        $this->addSitePageSection($sitemap, 'services', 'pages.services.show', 0.85);
        $this->addSitePageSection($sitemap, 'technology', 'pages.technology.show', 0.8);
        $this->addSitePageSection($sitemap, 'work', 'pages.work.show', 0.8);
        $this->addSitePageSection($sitemap, 'industries', 'pages.industries.show', 0.75);

        Blog::query()
            ->where('status', '1')
            ->get()
            ->each(fn (Blog $blog) => $sitemap->add(
                Url::create(route('pages.blog.detail', $blog->slug))
                    ->setLastModificationDate($blog->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.8)
            ));

        BlogCategories::query()->get()->each(fn (BlogCategories $cat) => $sitemap->add(
            Url::create(route('pages.blog.category.detail', $cat->slug))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.6)
        ));

        NewsCategory::query()
            ->whereNotNull('slug')
            ->get()
            ->each(fn (NewsCategory $cat) => $sitemap->add(
                Url::create(route('pages.news.detail', ['slug' => $cat->slug]))
                    ->setLastModificationDate($cat->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                    ->setPriority(0.6)
            ));

        Pages::query()
            ->where('status', '1')
            ->whereNotNull('slug')
            ->get()
            ->each(fn (Pages $page) => $sitemap->add(
                Url::create(route('p.pages', ['slug' => $page->slug]))
                    ->setLastModificationDate($page->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            ));

        $placeCategories = PlaceCategory::query()->where('is_active', '1')->get();

        City::query()->get()->each(function (City $city) use ($sitemap, $placeCategories) {
            $sitemap->add(
                Url::create(route('pages.cities.detail', $city->slug))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            );

            $placeCategories->each(function (PlaceCategory $category) use ($city, $sitemap) {
                $sitemap->add(
                    Url::create(route('pages.cities.businesses.list', [
                        'slug' => $city->slug,
                        'category' => Str::slug($category->name),
                    ]))
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.5)
                );
            });
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('sitemap.xml written');
    }

    private function writePostBuilderSitemap(): void
    {
        $sitemap = Sitemap::create()
            ->add(
                Url::create(route('pages.postset.list'))
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );

        PostSet::query()
            ->where('image_id', '>', 0)
            ->where('status', 'created')
            ->get()
            ->each(fn (PostSet $post) => $sitemap->add(
                Url::create(route('pages.postset.post.generator', $post->slug))
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.7)
            ));

        $sitemap->writeToFile(public_path('news_sitemap.xml'));
        $this->info('news_sitemap.xml written (Post Builder)');
    }

    private function writeAiSitemap(): void
    {
        $sitemap = Sitemap::create()
            ->add(
                Url::create(route('pages.ai_prompts.list'))
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );

        AiPromptCategory::query()
            ->where('is_active', true)
            ->whereNotNull('slug')
            ->get()
            ->each(fn (AiPromptCategory $cat) => $sitemap->add(
                Url::create(route('pages.ai_prompts.category', ['slug' => $cat->slug]))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            ));

        AiPrompt::query()
            ->where('is_active', true)
            ->whereNotNull('slug')
            ->get()
            ->each(fn (AiPrompt $prompt) => $sitemap->add(
                Url::create(route('pages.ai_prompts.detail', ['slug' => $prompt->slug]))
                    ->setLastModificationDate($prompt->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.7)
            ));

        $sitemap->writeToFile(public_path('ai_sitemap.xml'));
        $this->info('ai_sitemap.xml written');
    }

    private function writeRobotsTxt(): void
    {
        $base = rtrim((string) config('app.url'), '/');

        $lines = [
            'User-agent: *',
            'Allow: /',
            '',
            '# Auth & dashboard',
            'Disallow: /login',
            'Disallow: /dashboard',
            'Disallow: /auth/',
            '',
            '# Unlisted project tools (noindex pages)',
            'Disallow: /project-brief',
            'Disallow: /project-estimate',
            'Disallow: /tech-stack',
            '',
            '# Forms / auth helpers',
            'Disallow: /business/add',
            '',
            '# Removed / redirected modules',
            'Disallow: /resume-builder',
            'Disallow: /generate-resume',
            '',
            '# Utility / binary endpoints',
            'Disallow: /city/generate-image',
            'Disallow: /cool-image/',
            'Disallow: /news-image/',
            'Disallow: /city-business-category-image/',
            'Disallow: /post-image/',
            'Disallow: /post-main/',
            '',
            "Sitemap: {$base}/sitemap.xml",
            "Sitemap: {$base}/news_sitemap.xml",
            "Sitemap: {$base}/ai_sitemap.xml",
            '',
        ];

        file_put_contents(public_path('robots.txt'), implode("\n", $lines));
        $this->info('robots.txt written');
    }

    private function addSitePageSection(Sitemap $sitemap, string $section, string $routeName, float $priority): void
    {
        $pages = SitePages::pages($section);

        foreach ($pages as $slug => $page) {
            if (! is_string($slug) || $slug === '') {
                continue;
            }

            $url = Url::create(route($routeName, ['slug' => $slug]))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority($priority);

            $sitemap->add($url);
        }
    }
}
