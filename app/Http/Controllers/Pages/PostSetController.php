<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\PostSet;
use App\Models\PostItem;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostSetController extends Controller
{
    public function index(Request $request): View
    {
        $metaData = [
            "title" => "Editable Carousel Post Sets for Instagram and Knowledge Sharing | GujjuTicks Post Builder",
            "description" => "Explore a curated library of customizable post sets covering various topics with visual storytelling. Ideal for Instagram carousels, knowledge hubs, and branded content - easily personalize and share as your own.",
            //"image" => "",
            "keywords" => "customizable Instagram posts, editable carousels, knowledge post sets, shareable visual content, educational content builder, dynamic post templates, branding-ready content, topic-based image posts, carousel content ideas, Instagram knowledge cards",
            "url" => route('pages.postset.list')
        ];
        $prompt = "Give me 9 point for 'history of Jamnagar' with 1 title, keywords, meta description, to create 10 Instagram post, also give me 1 proper caption with rich hashtags and whatever best for Instagram. Make sure you give it all in proper associative array in below format. Do not include emojis in title or posts, but you can in caption.
        [
        'title' => '',
        'posts' => [
            [
            'title' => '',
            'description' => ''
            ]
        ],
        'caption' => '',
        'keywords' => '',
        'meta_description' => ''
        ]";

        $dataList = PostSet::where('image_id', '>', '0')->orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        $metaData['prev'] = $dataList->previousPageUrl() ?? null;

        return view('pages.postset.list', ['metaData' => $metaData, 'prompt' => $prompt, 'dataList' => $dataList]);
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.postset.list')->withErrors($validator)->withInput();
        }

        try {
            // Convert the input PHP array string into a real PHP array
            $array = eval('return ' . $request->input('data') . ';');

            if (!is_array($array) || !isset($array['title']) || !isset($array['posts'])) {
                return back()->withErrors(['data' => 'Invalid format. Make sure it contains title and posts.']);
            }

            $postSet = PostSet::create([
                'title' => $array['title'],
                'slug' => Str::slug($array['title']),
                'meta_description' => $array['meta_description'],
                'keywords' => $array['keywords'],
                'image_id' => 8,
                'caption' => $array['caption'] ?? null,
            ]);

            if ($postSet && isset($postSet->id)) {
                $order = 1;
                foreach ($array['posts'] as $post) {
                    PostItem::create([
                        'post_set_id' => $postSet->id,
                        'title' => $post['title'],
                        'order' => $order++ . '.',
                        'image_id' => 6,
                        'slug' => Str::slug($post['title']) . '-' . $postSet->id . '-' . rand(1000, 9999),
                        'description' => $post['description'],
                    ]);
                }
            }
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('pages.postset.list')->with($message);
        } catch (\Throwable $e) {
            return back()->withErrors(['data' => 'Failed to parse or save: ' . $e->getMessage()]);
        }
    }

    public function generator(Request $request, $slug)
    {
        $dataDetail = PostSet::where("slug", $slug)->first();
        if ($dataDetail) {
            $metaData = [
                "title" => $dataDetail->title,
                "description" => $dataDetail->meta_description,
                "image" => route('pages.image.postmain', ['slug' => $dataDetail->slug . '.jpg']),
                "keywords" => $dataDetail->keywords,
                "url" => route('pages.resume.list')
            ];
            return view('pages.postset.builder', ['metaData' => $metaData, 'dataDetail' => $dataDetail]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('pages.postset.list')->with($message);
        }
    }
}
