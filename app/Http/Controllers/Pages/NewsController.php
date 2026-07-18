<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\News;
use App\Models\NewsCategory;
use URL;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $categories = NewsCategory::whereNull('parent_id')
            ->withCount('children')
            ->orderBy('name', 'ASC')
            ->get();

        $tickerLines = News::query()
            ->where('is_published', 1)
            ->orderByDesc('id')
            ->limit(10)
            ->pluck('title')
            ->filter()
            ->values()
            ->all();

        if (empty($tickerLines)) {
            $tickerLines = [
                'Morning brief · Gujarat desk',
                'India headlines refreshing',
                'Local notes · city updates',
                'Category wire · topic stack',
                'Breaking queue cleared',
                'Evening wrap preparing',
            ];
        }

        $metaData = [
            "title" => "Latest Gujarat & India News | GujjuTicks News",
            "description" => "Catch the latest news, top stories, and real-time updates from Gujarat and across India. Stay informed with GujjuTicks – your source for reliable Gujarati and Indian news.",
            "keywords" => "Gujarat news, India news, Gujarati news updates, breaking news Gujarat, Indian headlines, current affairs India, GujjuTicks news, latest Gujarat news, trending India news, local Gujarati news",
            "url" => route('pages.news.list')
        ];

        return view('pages.news.list', [
            'metaData' => $metaData,
            'categories' => $categories,
            'tickerLines' => $tickerLines,
            'stats' => [
                'categories' => $categories->count(),
                'topics' => NewsCategory::whereNotNull('parent_id')->count(),
                'stories' => News::count(),
            ],
        ]);
    }

    public function view(Request $request, $slug)
    {
        $dataDetail = NewsCategory::where("slug", $slug)->first();
        if ($dataDetail) {
            $metaData = [
                "title" => "News on " . $dataDetail->name . " | GujjuTicks",
                "description" => $dataDetail->meta_description ?: ("Browse latest news stories in " . $dataDetail->name . "."),
                "image" => !empty($dataDetail->image)
                    ? URL::asset('/images/news/' . $dataDetail->image)
                    : null,
                "url" => route('pages.news.detail', ['slug' => $dataDetail->slug]),
            ];

            $dataList = NewsCategory::where('parent_id', $dataDetail->id)
                ->orderBy('name', 'ASC')
                ->get();

            $dataListNews = News::query()->where('is_featured', 0);

            if (!empty($dataDetail->parent_id)) {
                $dataListNews->where('news_category_id', $dataDetail->id);
            } else {
                $ids = $dataList->pluck('id')->push($dataDetail->id)->unique()->values()->all();
                $dataListNews->whereIn('news_category_id', $ids);
            }

            $dataListNews = $dataListNews->orderByDesc('id')->paginate(9)->withQueryString();

            return view('pages.news.view', [
                'dataDetail' => $dataDetail,
                'metaData' => $metaData,
                'dataList' => $dataList,
                'dataListNews' => $dataListNews,
            ]);
        }

        $message = [
            "message" => [
                "type" => "error",
                "title" => __('dashboard.bad'),
                "description" => __('dashboard.no_record_found'),
            ],
        ];
        return redirect()->route('pages.news.list')->with($message);
    }
}
