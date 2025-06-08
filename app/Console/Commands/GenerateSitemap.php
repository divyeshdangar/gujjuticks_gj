<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Blog;
use App\Models\BlogCategories;


class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap.xml for blogs and categories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create(route('home'))->setPriority(1)); // optional: add your homepage

        $sitemap->add(Url::create(route('form.contact'))->setPriority(0.8));
        $sitemap->add(Url::create(route('pages.blog.list'))->setPriority(0.8));

        Blog::where('status', '1')
            ->get()
            ->each(fn($blog) => $sitemap->add(
                Url::create(route('pages.blog.detail', $blog->slug))
                    ->setLastModificationDate($blog->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.8)
            ));

        // 2️⃣ Add category pages
        BlogCategories::get()
            ->each(fn($cat) => $sitemap->add(
                Url::create(route('pages.blog.category.detail', $cat->slug))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            ));

        // 3️⃣ Write to public/sitemap.xml
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ sitemap.xml generated in /public');
    }
}
