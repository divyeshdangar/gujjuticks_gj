<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
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

        $title = 'Latest Gujarat & India News | GujjuTicks News';
        $description = 'Catch the latest news, top stories, and real-time updates from Gujarat and across India. Stay informed with GujjuTicks – your source for reliable Gujarati and Indian news.';
        $url = route('pages.news.list');

        $metaData = [
            'title' => $title,
            'description' => $description,
            'keywords' => 'Gujarat news, India news, Gujarati news updates, breaking news Gujarat, Indian headlines, current affairs India, GujjuTicks news',
            'url' => $url,
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'image_alt' => $title,
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'schema' => [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'CollectionPage',
                        '@id' => $url . '#webpage',
                        'url' => $url,
                        'name' => $title,
                        'description' => $description,
                    ],
                    [
                        '@type' => 'ItemList',
                        'itemListElement' => $categories->take(20)->values()->map(function (NewsCategory $cat, int $i) {
                            return [
                                '@type' => 'ListItem',
                                'position' => $i + 1,
                                'name' => $cat->name,
                                'url' => route('pages.news.detail', ['slug' => $cat->slug]),
                            ];
                        })->all(),
                    ],
                    [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                            ['@type' => 'ListItem', 'position' => 2, 'name' => 'News', 'item' => $url],
                        ],
                    ],
                ],
            ],
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
        $dataDetail = NewsCategory::where('slug', $slug)->first();
        if (! $dataDetail) {
            return redirect()->route('pages.news.list')->with([
                'message' => [
                    'type' => 'error',
                    'title' => __('dashboard.bad'),
                    'description' => __('dashboard.no_record_found'),
                ],
            ]);
        }

        $title = 'News on ' . $dataDetail->name . ' | GujjuTicks';
        $description = trim((string) ($dataDetail->meta_description ?? '')) !== ''
            ? $dataDetail->meta_description
            : ('Browse latest news stories in ' . $dataDetail->name . ' — headlines and updates from Gujarat and India.');
        $url = route('pages.news.detail', ['slug' => $dataDetail->slug]);
        $image = ! empty($dataDetail->image)
            ? URL::asset('/images/news/' . $dataDetail->image)
            : asset('brand/pages/gujjuticks-homepage.png');

        $dataList = NewsCategory::where('parent_id', $dataDetail->id)
            ->orderBy('name', 'ASC')
            ->get();

        $dataListNews = News::query()->where('is_featured', 0);

        if (! empty($dataDetail->parent_id)) {
            $dataListNews->where('news_category_id', $dataDetail->id);
        } else {
            $ids = $dataList->pluck('id')->push($dataDetail->id)->unique()->values()->all();
            $dataListNews->whereIn('news_category_id', $ids);
        }

        $dataListNews = $dataListNews->orderByDesc('id')->paginate(9)->withQueryString();

        $metaData = [
            'title' => $title,
            'description' => $description,
            'keywords' => trim((string) ($dataDetail->keywords ?? '')) !== ''
                ? $dataDetail->keywords
                : ($dataDetail->name . ', Gujarat news, India news, GujjuTicks'),
            'image' => $image,
            'image_alt' => $title,
            'url' => $url,
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'prev' => $dataListNews->previousPageUrl(),
            'next' => $dataListNews->nextPageUrl(),
            'schema' => [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'CollectionPage',
                        '@id' => $url . '#webpage',
                        'url' => $url,
                        'name' => $title,
                        'description' => $description,
                    ],
                    [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                            ['@type' => 'ListItem', 'position' => 2, 'name' => 'News', 'item' => route('pages.news.list')],
                            ['@type' => 'ListItem', 'position' => 3, 'name' => $dataDetail->name, 'item' => $url],
                        ],
                    ],
                ],
            ],
        ];

        return view('pages.news.view', [
            'dataDetail' => $dataDetail,
            'metaData' => $metaData,
            'dataList' => $dataList,
            'dataListNews' => $dataListNews,
        ]);
    }
}
