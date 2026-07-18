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
        $baseTitle = 'Journal — Software, Technology & AI | GujjuTicks';
        $title = $page > 1 ? $baseTitle . ' · Page ' . $page : $baseTitle;
        $description = 'The GujjuTicks journal: essays on software craft, AI, and building products for international teams.';
        if ($request->filled('search')) {
            $description = 'Search results for “' . $request->string('search') . '” in the GujjuTicks journal.';
            $title = 'Search: ' . $request->string('search') . ' | GujjuTicks Journal';
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
            'keywords' => 'GujjuTicks insights, software engineering blog, AI product strategy, technology leadership, digital transformation, software company blog',
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'image_alt' => 'GujjuTicks — software, technology and AI insights',
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
                        'description' => 'GujjuTicks builds software, technology products, and AI solutions for teams worldwide.',
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
                        'inLanguage' => 'en',
                        'isPartOf' => ['@id' => 'https://www.gujjuticks.com/#website'],
                        'about' => [
                            ['@type' => 'Thing', 'name' => 'Software Engineering'],
                            ['@type' => 'Thing', 'name' => 'Artificial Intelligence'],
                            ['@type' => 'Thing', 'name' => 'Product Development'],
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
                                'name' => 'Journal',
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
        $dataDetail = Blog::with(['user', 'category'])
            ->where('slug', $slug)
            ->where('status', '1')
            ->first();
        if ($dataDetail) {
            $image = URL::asset('/images/blog/' . $dataDetail->image);
            $url = route('pages.blog.detail', ['slug' => $dataDetail->slug]);
            $description = $dataDetail->meta_description
                ?: \Illuminate\Support\Str::limit(strip_tags($dataDetail->description ?? ''), 160);

            $metaData = [
                'title' => $dataDetail->title . ' | GujjuTicks Journal',
                'description' => $description,
                'keywords' => trim(($dataDetail->category->title ?? 'Journal') . ', GujjuTicks, software, technology, AI'),
                'image' => $image,
                'image_alt' => $dataDetail->title,
                'url' => $url,
                'og_type' => 'article',
                'published_time' => optional($dataDetail->created_at)->toAtomString(),
                'modified_time' => optional($dataDetail->updated_at ?? $dataDetail->created_at)->toAtomString(),
                'author_name' => $dataDetail->user->name ?? 'GujjuTicks',
                'section' => $dataDetail->category->title ?? 'Journal',
                'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
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
                        ],
                        [
                            '@type' => 'BreadcrumbList',
                            'itemListElement' => array_values(array_filter([
                                [
                                    '@type' => 'ListItem',
                                    'position' => 1,
                                    'name' => 'Home',
                                    'item' => route('home'),
                                ],
                                [
                                    '@type' => 'ListItem',
                                    'position' => 2,
                                    'name' => 'Journal',
                                    'item' => route('pages.blog.list'),
                                ],
                                $dataDetail->category ? [
                                    '@type' => 'ListItem',
                                    'position' => 3,
                                    'name' => $dataDetail->category->title,
                                    'item' => route('pages.blog.category.detail', ['slug' => $dataDetail->category->slug]),
                                ] : null,
                                [
                                    '@type' => 'ListItem',
                                    'position' => $dataDetail->category ? 4 : 3,
                                    'name' => $dataDetail->title,
                                    'item' => $url,
                                ],
                            ])),
                        ],
                        [
                            '@type' => 'BlogPosting',
                            '@id' => $url . '#article',
                            'headline' => $dataDetail->title,
                            'description' => $description,
                            'image' => [$image],
                            'datePublished' => optional($dataDetail->created_at)->toAtomString(),
                            'dateModified' => optional($dataDetail->updated_at ?? $dataDetail->created_at)->toAtomString(),
                            'mainEntityOfPage' => [
                                '@type' => 'WebPage',
                                '@id' => $url,
                            ],
                            'author' => [
                                '@type' => 'Person',
                                'name' => $dataDetail->user->name ?? 'GujjuTicks',
                            ],
                            'publisher' => [
                                '@id' => 'https://www.gujjuticks.com/#organization',
                            ],
                            'articleSection' => $dataDetail->category->title ?? 'Journal',
                            'inLanguage' => 'en',
                        ],
                    ],
                ],
            ];

            $dataList = Blog::with(['user', 'category'])
                ->where('status', '1')
                ->where('id', '<>', $dataDetail->id)
                ->when($dataDetail->category_id, function ($q) use ($dataDetail) {
                    $q->where('category_id', $dataDetail->category_id);
                })
                ->orderByDesc('id')
                ->limit(3)
                ->get();

            if ($dataList->count() < 3) {
                $exclude = $dataList->pluck('id')->push($dataDetail->id)->all();
                $more = Blog::with(['user', 'category'])
                    ->where('status', '1')
                    ->whereNotIn('id', $exclude)
                    ->orderByDesc('id')
                    ->limit(3 - $dataList->count())
                    ->get();
                $dataList = $dataList->concat($more);
            }

            return view('pages.blog.view', [
                'dataDetail' => $dataDetail,
                'lang' => $this->languages,
                'metaData' => $metaData,
                'dataList' => $dataList,
            ]);
        }

        $message = [
            'message' => [
                'type' => 'error',
                'title' => __('dashboard.bad'),
                'description' => __('dashboard.no_record_found'),
            ],
        ];
        return redirect()->route('home')->with($message);
    }

    public function category(Request $request, $slug)
    {
        $dataDetail = BlogCategories::where('slug', $slug)->first();
        if ($dataDetail) {
            $page = max(1, (int) $request->get('page', 1));
            $description = $dataDetail->meta_description
                ?: \Illuminate\Support\Str::limit(strip_tags($dataDetail->description ?? ''), 160)
                ?: 'Articles on ' . $dataDetail->title . ' from the GujjuTicks journal.';
            $image = $dataDetail->image
                ? URL::asset('/images/blog-category/' . $dataDetail->image)
                : asset('files/images/blogs-listing-page.png');
            $url = route('pages.blog.category.detail', ['slug' => $dataDetail->slug]);
            $titleBase = $dataDetail->title . ' | GujjuTicks Journal';
            $title = $page > 1 ? $titleBase . ' · Page ' . $page : $titleBase;

            if ($request->filled('search')) {
                $title = 'Search: ' . $request->string('search') . ' in ' . $dataDetail->title . ' | GujjuTicks';
                $description = 'Search results for “' . $request->string('search') . '” in ' . $dataDetail->title . '.';
            }

            $canonical = $page > 1
                ? route('pages.blog.category.detail', array_filter([
                    'slug' => $dataDetail->slug,
                    'page' => $page,
                    'search' => $request->get('search'),
                ]))
                : route('pages.blog.category.detail', array_filter([
                    'slug' => $dataDetail->slug,
                    'search' => $request->get('search'),
                ]));

            $dataList = Blog::with(['user', 'category'])
                ->where('status', '1')
                ->where('category_id', $dataDetail->id)
                ->when($request->filled('search'), function ($q) use ($request) {
                    $term = '%' . $request->string('search') . '%';
                    $q->where(function ($inner) use ($term) {
                        $inner->where('title', 'LIKE', $term)
                            ->orWhere('description', 'LIKE', $term)
                            ->orWhere('meta_description', 'LIKE', $term);
                    });
                })
                ->orderByDesc('id')
                ->paginate(9)
                ->withQueryString();

            $itemList = [];
            foreach ($dataList->items() as $index => $blog) {
                $itemList[] = [
                    '@type' => 'ListItem',
                    'position' => (($dataList->currentPage() - 1) * $dataList->perPage()) + $index + 1,
                    'url' => route('pages.blog.detail', ['slug' => $blog->slug]),
                    'name' => $blog->title,
                ];
            }

            $metaData = [
                'title' => $title,
                'description' => $description,
                'keywords' => $dataDetail->title . ', GujjuTicks journal, software, technology, AI',
                'image' => $image,
                'image_alt' => $dataDetail->title . ' — GujjuTicks Journal',
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
                        ],
                        [
                            '@type' => 'CollectionPage',
                            '@id' => $canonical . '#webpage',
                            'url' => $canonical,
                            'name' => $title,
                            'description' => $description,
                            'isPartOf' => [
                                '@type' => 'WebSite',
                                'name' => 'GujjuTicks',
                                'url' => 'https://www.gujjuticks.com/',
                            ],
                            'about' => [
                                '@type' => 'Thing',
                                'name' => $dataDetail->title,
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
                                    'name' => 'Journal',
                                    'item' => route('pages.blog.list'),
                                ],
                                [
                                    '@type' => 'ListItem',
                                    'position' => 3,
                                    'name' => $dataDetail->title,
                                    'item' => $url,
                                ],
                            ],
                        ],
                    ],
                ],
            ];

            $categories = BlogCategories::withCount(['blogs' => function ($q) {
                $q->where('status', '1');
            }])
                ->where('status', '1')
                ->whereNull('parent_id')
                ->where('id', '<>', $dataDetail->id)
                ->orderBy('title')
                ->limit(12)
                ->get();

            $subCategories = BlogCategories::where('status', '1')
                ->where('parent_id', $dataDetail->id)
                ->orderBy('title')
                ->get();

            return view('pages.blog.category', [
                'dataDetail' => $dataDetail,
                'lang' => $this->languages,
                'metaData' => $metaData,
                'dataList' => $dataList,
                'categories' => $categories,
                'subCategories' => $subCategories,
            ]);
        }

        $message = [
            'message' => [
                'type' => 'error',
                'title' => __('dashboard.bad'),
                'description' => __('dashboard.no_record_found'),
            ],
        ];
        return redirect()->route('home')->with($message);
    }
}
