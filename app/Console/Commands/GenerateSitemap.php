<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Blog;
use App\Models\BlogCategories;
use App\Models\City;
use Illuminate\Support\Str;
use App\Models\PlaceCategory;

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
            ->add(Url::create(route('home'))->setPriority(1));
        $sitemap->add(Url::create(route('form.contact'))->setPriority(0.8));
        $sitemap->add(Url::create(route('pages.blog.list'))->setPriority(0.8));
        $sitemap->add(Url::create(route('pages.cities.list'))->setPriority(0.8));
        $sitemap->add(Url::create(route('pages.resume.list'))->setPriority(0.8));

        Blog::where('status', '1')
            ->get()
            ->each(fn($blog) => $sitemap->add(
                Url::create(route('pages.blog.detail', $blog->slug))
                    ->setLastModificationDate($blog->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.8)
            ));

        BlogCategories::get()
            ->each(fn($cat) => $sitemap->add(
                Url::create(route('pages.blog.category.detail', $cat->slug))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            ));

        // City::get()
        //     ->each(fn($city) => $sitemap->add(
        //         Url::create(route('pages.cities.detail', $city->slug))
        //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
        //             ->setPriority(0.6)
        //     ));

        City::get()->each(function ($city) use ($sitemap) {
            // Add city detail page
            $sitemap->add(
                Url::create(route('pages.cities.detail', $city->slug))
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            );

            // Add city + category pages
            PlaceCategory ::where('is_active', '1')->get()->each(function ($category) use ($city, $sitemap) {
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

        $this->info('✅ sitemap.xml generated in /public');
    }
}
