<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\City;
use App\Models\PlaceCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use URL;

class CitiesController extends Controller
{
    public function index(Request $request): View
    {
        $title = 'GujjuTicks City Directory - Gujarat’s Top Cities';
        $description = 'Browse Gujarat’s top cities on GujjuTicks. From Ahmedabad to Bhavnagar, discover businesses, attractions, news and resources for every city in the state.';
        $url = route('pages.cities.list');

        $dataList = City::query()
            ->searching()
            ->withCount(['businesses as businesses_count' => fn ($q) => $q->published()])
            ->orderBy('name', 'ASC')
            ->paginate(12)
            ->withQueryString();

        $categories = PlaceCategory::where('is_active', '1')
            ->orderBy('label', 'ASC')
            ->limit(18)
            ->get();

        $stats = [
            'cities' => City::count(),
            'categories' => PlaceCategory::where('is_active', '1')->count(),
            'businesses' => Business::published()->count(),
        ];

        $metaData = [
            'title' => $title,
            'description' => $description,
            'keywords' => 'GujjuTicks city directory, Gujarat city list, Gujarat travel guide, Ahmedabad, Surat, Rajkot, Vadodara, Bhavnagar',
            'url' => $url,
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'image_alt' => $title,
            'robots' => $request->filled('search')
                ? 'noindex, follow'
                : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'prev' => $dataList->previousPageUrl(),
            'next' => $dataList->nextPageUrl(),
            'schema' => $this->collectionSchema($title, $description, $url, $dataList->getCollection()->take(12)->map(function (City $city, int $i) {
                return [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $city->name,
                    'url' => route('pages.cities.detail', ['slug' => $city->slug]),
                ];
            })->values()->all()),
        ];

        return view('pages.cities.list', [
            'metaData' => $metaData,
            'dataList' => $dataList,
            'categories' => $categories,
            'stats' => $stats,
            'searchTerm' => $request->get('search'),
        ]);
    }

    public function view(Request $request, $slug)
    {
        $dataDetail = City::where('slug', $slug)
            ->withCount(['businesses as businesses_count' => fn ($q) => $q->published()])
            ->first();

        if (! $dataDetail) {
            return redirect()->route('home')->with([
                'message' => [
                    'type' => 'error',
                    'title' => __('dashboard.bad'),
                    'description' => __('dashboard.no_record_found'),
                ],
            ]);
        }

        $title = trim((string) $dataDetail->title) !== ''
            ? $dataDetail->title
            : ($dataDetail->name . ' city guide');
        $description = trim((string) ($dataDetail->meta_description ?? '')) !== ''
            ? $dataDetail->meta_description
            : ('Explore businesses, categories, and local resources in ' . $dataDetail->name . ' on GujjuTicks.');
        $url = route('pages.cities.detail', ['slug' => $dataDetail->slug]);
        $image = ! empty($dataDetail->image)
            ? URL::asset('/images/cities/' . $dataDetail->image)
            : asset('brand/pages/gujjuticks-homepage.png');

        $categories = PlaceCategory::where('is_active', '1')
            ->orderBy('label', 'ASC')
            ->get();

        $dataList = City::where('id', '<>', $dataDetail->id)
            ->withCount(['businesses as businesses_count' => fn ($q) => $q->published()])
            ->orderBy('name', 'ASC')
            ->limit(3)
            ->get();

        $stats = [
            'categories' => $categories->count(),
            'businesses' => $dataDetail->businesses_count,
        ];

        $metaData = [
            'title' => $title . ' - GujjuTicks',
            'no_title' => true,
            'description' => $description,
            'keywords' => $dataDetail->name . ', Gujarat cities, city directory, local businesses, GujjuTicks',
            'image' => $image,
            'image_alt' => $title,
            'url' => $url,
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'schema' => [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'Place',
                        '@id' => $url . '#place',
                        'name' => $dataDetail->name,
                        'description' => $description,
                        'url' => $url,
                        'image' => $image,
                    ],
                    [
                        '@type' => 'WebPage',
                        '@id' => $url . '#webpage',
                        'url' => $url,
                        'name' => $title,
                        'description' => $description,
                        'isPartOf' => [
                            '@type' => 'WebSite',
                            'name' => 'GujjuTicks',
                            'url' => 'https://www.gujjuticks.com/',
                        ],
                    ],
                    [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => [
                            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Cities', 'item' => route('pages.cities.list')],
                            ['@type' => 'ListItem', 'position' => 3, 'name' => $dataDetail->name, 'item' => $url],
                        ],
                    ],
                ],
            ],
        ];

        return view('pages.cities.view', [
            'dataDetail' => $dataDetail,
            'metaData' => $metaData,
            'dataList' => $dataList,
            'categories' => $categories,
            'stats' => $stats,
        ]);
    }

    public function category_businesses_list(Request $request, $slug, $category)
    {
        $dataDetail = City::where('slug', $slug)->first();
        if (! $dataDetail) {
            return redirect()->route('home')->with([
                'message' => [
                    'type' => 'error',
                    'title' => __('dashboard.bad'),
                    'description' => __('dashboard.no_record_found'),
                ],
            ]);
        }

        $businessCategory = PlaceCategory::where('name', str_replace('-', '_', $category))->first();
        if (! $businessCategory) {
            return redirect()->route('home')->with([
                'message' => [
                    'type' => 'error',
                    'title' => __('dashboard.bad'),
                    'description' => __('dashboard.no_record_found'),
                ],
            ]);
        }

        $title = $businessCategory->label . ' in ' . $dataDetail->name . ' - GujjuTicks';
        $description = $businessCategory->getMetaDescription($dataDetail->name)
            ?: ('Find ' . $businessCategory->label . ' in ' . $dataDetail->name . ' — ratings, details, and local listings on GujjuTicks.');
        $url = route('pages.cities.businesses.list', [
            'slug' => $dataDetail->slug,
            'category' => str_replace('_', '-', $businessCategory->name),
        ]);

        $dataList = Business::published()
            ->where('city_id', $dataDetail->id)
            ->where('place_category_id', $businessCategory->id)
            ->orderByDesc('rating')
            ->orderByDesc('user_ratings_total')
            ->paginate(10)
            ->withQueryString();

        $citiesList = City::where('id', '<>', $dataDetail->id)
            ->withCount(['businesses as businesses_count' => fn ($q) => $q->published()])
            ->orderBy('name', 'ASC')
            ->limit(3)
            ->get();

        $siblingCategories = PlaceCategory::where('is_active', '1')
            ->where('id', '<>', $businessCategory->id)
            ->orderBy('label', 'ASC')
            ->limit(12)
            ->get();

        $metaData = [
            'title' => $title,
            'no_title' => true,
            'description' => $description,
            'keywords' => $businessCategory->label . ', ' . $dataDetail->name . ', Gujarat businesses, GujjuTicks',
            'image' => route('pages.image.category', [
                'slug' => str_replace('_', '-', $businessCategory->name) . '-in-' . $dataDetail->slug . '.jpg',
            ]),
            'image_alt' => $title,
            'url' => $url,
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'prev' => $dataList->previousPageUrl(),
            'next' => $dataList->nextPageUrl(),
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
                            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Cities', 'item' => route('pages.cities.list')],
                            ['@type' => 'ListItem', 'position' => 3, 'name' => $dataDetail->name, 'item' => route('pages.cities.detail', ['slug' => $dataDetail->slug])],
                            ['@type' => 'ListItem', 'position' => 4, 'name' => $businessCategory->label, 'item' => $url],
                        ],
                    ],
                ],
            ],
        ];

        return view('pages.cities.category_businesses_list', [
            'dataList' => $dataList,
            'dataDetail' => $dataDetail,
            'metaData' => $metaData,
            'businessCategory' => $businessCategory,
            'citiesList' => $citiesList,
            'siblingCategories' => $siblingCategories,
        ]);
    }

    private function collectionSchema(string $title, string $description, string $url, array $listItems): array
    {
        return [
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
                    'itemListElement' => $listItems,
                ],
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                        ['@type' => 'ListItem', 'position' => 2, 'name' => 'Cities', 'item' => $url],
                    ],
                ],
            ],
        ];
    }
}
