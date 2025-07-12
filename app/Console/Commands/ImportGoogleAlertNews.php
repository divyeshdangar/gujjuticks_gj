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
        $feeds = NewsFeed::with('category')
            ->where(function ($query) {
                $query->whereNull('last_called_at')
                    ->orWhere('last_called_at', '<=', now()->subMinutes(5));
            })
            ->orderBy('last_called_at', 'asc')
            ->limit(3)
            ->get();

        foreach ($feeds as $feed) {
            try {
                $xml = simplexml_load_file($feed->url);

                // ✅ Update last_called_at after successful import
                $feed->update(['last_called_at' => now()]);
                
                // Google Alerts uses Atom namespace
                $entries = $xml->entry ?? [];

                if (empty($entries)) {
                    Log::info("No entries found in feed: {$feed->id} {$feed->url}");
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
                Log::error("Error reading feed [$feed->url]: " . $e->getMessage());
            }

            sleep(10);
        }

        Log::info("All feeds processed.");
    }
}
