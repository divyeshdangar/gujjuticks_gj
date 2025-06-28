<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NewsFeed;
use App\Models\News;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ImportGoogleAlertNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-google-alert-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Google Alert RSS feed into news table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $feedUrls = [
            'https://www.google.com/alerts/feeds/10574946886415694362/6422504717856592052', //Gujarat
            'https://www.google.com/alerts/feeds/10574946886415694362/11471954644524627028', //India
            'https://www.google.com/alerts/feeds/10574946886415694362/17434958478350299103', //Ahmedabad
            'https://www.google.com/alerts/feeds/10574946886415694362/2535201726166280612', //Jamnagar
        ];


        $feeds = NewsFeed::with('category')->get();
        $importedCount = 0;
        foreach ($feeds as $feed) {
            try {
                $xml = simplexml_load_file($feed->url);

                // Google Alerts uses Atom namespace
                $entries = $xml->entry ?? [];

                if (empty($entries)) {
                    Log::warn("No entries found in feed: {$feed->id} {$feed->url}");
                    continue;
                }

                foreach ($entries as $entry) {
                    $title = (string) $entry->title;
                    $slug = Str::slug(strip_tags($title));

                    if (News::where('slug', $slug)->exists()) {
                        continue;
                    }

                    $content = (string) $entry->content;
                    $published = Carbon::parse((string) $entry->published);
                    $link = null;
                    foreach ($entry->link as $l) {
                        $attrs = $l->attributes();
                        if (isset($attrs['href'])) {
                            $link = (string) $attrs['href'];
                            break;
                        }
                    }

                    News::create([
                        'title' => $title,
                        'slug' => $slug,
                        'link' => $link,
                        'content' => $content,
                        'location' => 'Gujarat',
                        'news_category_id' => $feed->news_category_id,
                        'is_published' => false,
                        'published_at' => $published,
                    ]);

                    Log::info("Imported: $title");
                }
            } catch (\Exception $e) {
                Log::error("Error reading feed [$url]: " . $e->getMessage());
            }
        }

        Log::info("All feeds processed.");
    }
}
