<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PostSet;
use App\Services\OpenAIService;
use App\Models\PostItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GeneratePostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-posts-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate post from given topic and add in database from OpenAi API.';

    /**
     * Execute the console command.
     */
    public function handle(OpenAIService $openAI)
    {
        Log::info("============== POST SET CHANGE ==============");
        $record = PostSet::where('status', 'pending')->first();
        if ($record) {
            Log::info("- Data fetching for: [" . $record->id . "] - " . $record->topic);


            $data = $openAI->generatePosts("Give me 9 point for '" . $record->topic . "' with 1 title, keywords, meta description, to create 10 Instagram post, also give me 1 proper caption with rich hashtags and whatever best for Instagram. Make sure you give it all in proper associative array in below format. Do not include emojis in title or posts, but you can in caption. [ 'title' => '', 'posts' => [ [ 'title' => '', 'description' => '' ] ], 'caption' => '', 'keywords' => '', 'meta_description' => '' ]");

            if (!is_array($data) || !isset($data['title']) || !isset($data['posts'])) {
                Log::error("- Data got from OpenAi is not in proper format.");
                return Command::FAILURE; 
            }

            $record->title = $data['title'];
            $record->slug = Str::slug($data['title']);


            $checkSlug = PostSet::where('slug', $record->slug)->first();
            if ($checkSlug) {
                $record->slug = $record->slug . '-' . rand(1000, 9999);
            }

            $record->meta_description = $data['meta_description'];
            $record->keywords = $data['keywords'];
            $record->status = "created";
            //$record->image_id = 8;
            $record->caption = $data['caption'] ?? null;
            $record->update();

            if ($record && isset($record->id)) {
                $order = 1;
                foreach ($data['posts'] as $post) {
                    PostItem::create([
                        'post_set_id' => $record->id,
                        'title' => $post['title'],
                        'order' => $order++ . '.',
                        'image_id' => 6,
                        'slug' => Str::slug($post['title']) . '-' . $record->id . '-' . rand(1000, 9999),
                        'description' => $post['description'],
                    ]);
                }
                Log::info("- " . $order . " post item added.");
            }
        } else {
            Log::warning("No pending post set found..!");
        }
        Log::info("============ POST SET CHANGE END ============");
        return Command::SUCCESS;
    }
}
