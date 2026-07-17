<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Blog;
use App\Models\BlogCategories;
use URL;

class BlogController extends Controller
{
    public $languages = [
        'e' => 'English',
        'h' => 'हिन्दी',
        'g' => 'ગુજરાતી'
    ];

    public function index(Request $request): View
    {
        $dataList = Blog::with(['user', 'category'])
            ->where('status', '1')
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = '%' . $request->string('search') . '%';
                $q->where(function ($inner) use ($term) {
                    $inner->where('title', 'LIKE', $term)
                        ->orWhere('description', 'LIKE', $term)
                        ->orWhere('meta_description', 'LIKE', $term);
                });
            })
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();

        $categories = BlogCategories::withCount(['blogs' => function ($q) {
            $q->where('status', '1');
        }])
            ->where('status', '1')
            ->whereNull('parent_id')
            ->orderBy('title')
            ->limit(15)
            ->get();

        $page = max(1, (int) $dataList->currentPage());
        $baseTitle = 'GujjuTicks Blogs — Software, Tech & AI Insights';
        $title = $page > 1 ? $baseTitle . ' (Page ' . $page . ')' : $baseTitle;
        $description = 'Read GujjuTicks articles on software development, technology, AI products, and building digital tools for modern businesses.';
        if ($request->filled('search')) {
            $description = 'Search results for “' . $request->string('search') . '” on GujjuTicks Blogs — software, tech, and AI insights.';
            $title = 'Search: ' . $request->string('search') . ' — GujjuTicks Blogs';
        }

        $canonical = $page > 1
            ? route('pages.blog.list', array_filter(['page' => $page, 'search' => $request->get('search')]))
            : route('pages.blog.list', array_filter(['search' => $request->get('search')]));

        $itemList = [];
        foreach ($dataList->items() as $index => $blog) {
            $itemList[] = [
                '@type' => 'ListItem',
                'position' => (($page - 1) * $dataList->perPage()) + $index + 1,
                'url' => route('pages.blog.detail', ['slug' => $blog->slug]),
                'name' => $blog->title,
            ];
        }

        $metaData = [
            'title' => $title,
            'description' => $description,
            'keywords' => 'GujjuTicks blogs, software insights, AI articles, technology blog, product development, digital tools',
            'image' => asset('files/images/blogs-listing-page.png'),
            'image_alt' => 'GujjuTicks Blogs — software, tech and AI insights',
            'url' => $canonical,
            'og_type' => 'website',
            'robots' => $request->filled('search')
                ? 'noindex, follow'
                : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'prev' => $dataList->previousPageUrl(),
            'next' => $dataList->nextPageUrl(),
            'schema' => [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'Organization',
                        '@id' => 'https://www.gujjuticks.com/#organization',
                        'name' => 'GujjuTicks',
                        'url' => 'https://www.gujjuticks.com/',
                        'logo' => [
                            '@type' => 'ImageObject',
                            'url' => asset('brand/full-logo-black.png'),
                        ],
                        'sameAs' => [
                            'https://www.instagram.com/gujjuticks/',
                            'https://twitter.com/gujjuticks',
                            'https://www.youtube.com/@gujjuticks',
                        ],
                    ],
                    [
                        '@type' => 'WebSite',
                        '@id' => 'https://www.gujjuticks.com/#website',
                        'url' => 'https://www.gujjuticks.com/',
                        'name' => 'GujjuTicks',
                        'publisher' => ['@id' => 'https://www.gujjuticks.com/#organization'],
                        'potentialAction' => [
                            '@type' => 'SearchAction',
                            'target' => route('pages.blog.list') . '?search={search_term_string}',
                            'query-input' => 'required name=search_term_string',
                        ],
                    ],
                    [
                        '@type' => 'CollectionPage',
                        '@id' => $canonical . '#webpage',
                        'url' => $canonical,
                        'name' => $title,
                        'description' => $description,
                        'isPartOf' => ['@id' => 'https://www.gujjuticks.com/#website'],
                        'about' => [
                            ['@type' => 'Thing', 'name' => 'Software'],
                            ['@type' => 'Thing', 'name' => 'Artificial Intelligence'],
                            ['@type' => 'Thing', 'name' => 'Technology'],
                        ],
                        'mainEntity' => [
                            '@type' => 'ItemList',
                            'numberOfItems' => count($itemList),
                            'itemListElement' => $itemList,
                        ],
                    ],
                    [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            [
                                '@type' => 'ListItem',
                                'position' => 1,
                                'name' => 'Home',
                                'item' => route('home'),
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 2,
                                'name' => 'Blogs',
                                'item' => route('pages.blog.list'),
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return view('pages.blog.list', [
            'metaData' => $metaData,
            'lang' => $this->languages,
            'dataList' => $dataList,
            'categories' => $categories,
        ]);
    }

    public function view(Request $request, $slug)
    {
        $dataDetail = Blog::where("slug", $slug)->first();
        if ($dataDetail) {
            $metaData = [
                "title" => $dataDetail->title . " - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                "image" => URL::asset('/images/blog/' . $dataDetail->image),
                "url" => route('pages.blog.detail', ['slug' => $dataDetail->slug])
            ];
            $categories = BlogCategories::where('status', '1')->where('parent_id', null)->limit(15)->get();

            $dataList = Blog::where("status", "1")->where('id', '<>', $dataDetail->id)->where('category_id', '<>', $dataDetail->category_id)->limit(3)->get();

            return view('pages.blog.view', ['dataDetail' => $dataDetail, 'lang' => $this->languages, 'metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('home')->with($message);
        }
    }

    public function category(Request $request, $slug)
    {
        $dataDetail = BlogCategories::where("slug", $slug)->first();
        if ($dataDetail) {
            $metaData = [
                "title" => $dataDetail->title . " - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                "image" => URL::asset('/images/blog-category/' . $dataDetail->image),
                "url" => route('pages.blog.category.detail', ['slug' => $dataDetail->slug]),

            ];
            $categories = BlogCategories::where("status", "1")->where("parent_id", null)->where('id', '<>', $dataDetail->id)->limit(3)->get();
            $subCategories = BlogCategories::where("status", "1")->where("parent_id", $dataDetail->id)->get();
            $dataList = Blog::where("status", "1")
                ->where('category_id', $dataDetail->id)
                ->searching()->paginate(6)->withQueryString();
            return view('pages.blog.category', ['dataDetail' => $dataDetail, 'lang' => $this->languages, 'metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories, 'subCategories' => $subCategories]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('home')->with($message);
        }
    }
}
