<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\PlaceCategory;
use App\Models\City;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BusinessController extends Controller
{
    public function business(Request $request): View
    {
        $categories = PlaceCategory::where('is_active', '1')
            ->withCount(['businesses' => fn ($q) => $q->published()])
            ->orderBy('label', 'ASC')
            ->get();

        $featuredCities = City::withCount(['businesses' => fn ($q) => $q->published()])
            ->orderByDesc('businesses_count')
            ->orderBy('name', 'ASC')
            ->limit(12)
            ->get();

        $metaData = [
            "title" => "Local Business Directory - Find Trusted Businesses on GujjuTicks",
            "description" => "Explore verified local businesses in your city on GujjuTicks. Find shops, services, professionals, and companies near you with contact details and reviews.",
            "keywords" => "local business directory, business listing, find local businesses, city directory, nearby services, shops near me, GujjuTicks business directory",
            "url" => route('pages.business'),
            "image" => asset('images/creative/Local-Business-Directory-Trusted-Businesses-on-GujjuTicks.jpg'),
            "robots" => "index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1",
            "schema" => [
                "@context" => "https://schema.org",
                "@type" => "WebSite",
                "name" => "GujjuTicks Business Directory",
                "url" => route('pages.business'),
                "description" => "Discover trusted local businesses, shops, services, and professionals near you on GujjuTicks Business Directory.",
                "inLanguage" => "en",
                "publisher" => [
                    "@type" => "Organization",
                    "name" => "GujjuTicks",
                    "url" => "https://www.gujjuticks.com/",
                    "logo" => [
                        "@type" => "ImageObject",
                        "url" => "https://www.gujjuticks.com/brand/pages/gujjuticks-home.png"
                    ],
                    "sameAs" => [
                        "https://www.instagram.com/gujjuticks/",
                        "https://twitter.com/gujjuticks",
                        "https://www.youtube.com/@gujjuticks"
                    ]
                ],
                "mainEntity" => [
                    "@type" => "CollectionPage",
                    "name" => "Local Business Directory",
                    "url" => route('pages.business'),
                    "about" => [
                        [
                            "@type" => "Thing",
                            "name" => "Local Businesses"
                        ],
                        [
                            "@type" => "Thing",
                            "name" => "Shops & Stores"
                        ],
                        [
                            "@type" => "Thing",
                            "name" => "Service Providers"
                        ],
                        [
                            "@type" => "Thing",
                            "name" => "Professionals"
                        ],
                        [
                            "@type" => "Thing",
                            "name" => "City Business Listings"
                        ]
                    ]
                ]
            ]
        ];

        return view('pages.business.business', [
            'metaData' => $metaData,
            'cities' => $featuredCities,
            'categories' => $categories,
            'stats' => [
                'cities' => City::count(),
                'categories' => $categories->count(),
                'businesses' => Business::published()->count(),
            ],
        ]);
    }

    public function add(Request $request): View
    {
        $categories = PlaceCategory::where('is_active', '1')->orderBy('label', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();

        $selectedCityId = old('city_id');
        if (!$selectedCityId && $request->filled('city')) {
            $selectedCityId = City::where('slug', $request->get('city'))->value('id');
        }

        $selectedCategoryId = old('place_category_id');
        if (!$selectedCategoryId && $request->filled('category')) {
            $categoryName = str_replace('-', '_', $request->get('category'));
            $selectedCategoryId = PlaceCategory::where('name', $categoryName)->value('id');
        }

        $metaData = [
            "title" => "Add Your Business - Get Listed in GujjuTicks Business Directory",
            "description" => "List your business for free in our city directory. Increase visibility, attract local customers, and grow your brand online in just a few minutes.",
            "keywords" => "add business, list business online, city business directory, local listing, free business listing, promote business, online directory, business registration",
            "url" => route('pages.business.add'),
            "robots" => "noindex, follow",
            "image" => asset('images/creative/Local-Business-Directory-Trusted-Businesses-on-GujjuTicks.jpg'),
            "image_alt" => "Add your business to the GujjuTicks directory",
        ];

        return view('pages.business.add', [
            'metaData' => $metaData,
            'cities' => $cities,
            'categories' => $categories,
            'selectedCityId' => $selectedCityId,
            'selectedCategoryId' => $selectedCategoryId,
            'stats' => [
                'cities' => $cities->count(),
                'categories' => $categories->count(),
                'businesses' => Business::published()->count(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'website' => $request->filled('website') ? $request->input('website') : null,
            'croppedImage' => $request->filled('croppedImage') ? $request->input('croppedImage') : null,
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'city_id' => 'required|exists:cities,id',
            'place_category_id' => 'required|exists:place_categories,id',
            'description' => 'required|max:2048',
            'address' => 'required|max:1048',
            'website' => 'nullable|url|max:255',
            'phone' => 'required|numeric|digits_between:10,12',
            'croppedImage' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.business.add')->withErrors($validator)->withInput();
        }

        $dataToInsert = $validator->validated();
        $category = PlaceCategory::find($dataToInsert['place_category_id']);

        $baseSlug = Str::slug($dataToInsert['name']) ?: 'business';
        $slug = $baseSlug;
        $suffix = 1;
        while (Business::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $suffix;
            $suffix++;
        }

        $data = [
            'name' => $dataToInsert['name'],
            'slug' => $slug,
            'place_id' => 'manual-' . Str::uuid()->toString(),
            'city_id' => $dataToInsert['city_id'],
            'place_category_id' => $dataToInsert['place_category_id'],
            'description' => $dataToInsert['description'],
            'address' => $dataToInsert['address'],
            'website' => $dataToInsert['website'] ?? null,
            'phone' => $dataToInsert['phone'],
            'category' => $category?->name,
            'status' => 'pending',
        ];

        if (!empty($dataToInsert['croppedImage'])) {
            $croped_image = $dataToInsert['croppedImage'];
            try {
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image) = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $image_name = Str::uuid() . '.png';
                $logoDir = public_path(config('paths.images.business_logo'));
                if (!is_dir($logoDir)) {
                    mkdir($logoDir, 0755, true);
                }
                file_put_contents($logoDir . DIRECTORY_SEPARATOR . $image_name, $croped_image);
                $data['icon'] = $image_name;
            } catch (\Throwable $e) {
                // If image processing fails, continue without blocking business creation
            }
        }

        $business = Business::create($data);
        if (!empty($business) && isset($business->id)) {
            Notification::create([
                'message_tag' => 'msg.new_business_added',
                'user_id' => Auth::id(),
                'extra_id' => $business->id,
            ]);
        }

        $message = [
            "message" => [
                "type" => "success",
                "title" => __('dashboard.great'),
                "description" => __('dashboard.details_submitted')
            ]
        ];
        return redirect()->route('dashboard.user')->with($message);
    }
}
