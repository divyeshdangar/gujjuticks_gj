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

class BusinessController extends Controller
{
    public function business(Request $request): View
    {
        $categories = PlaceCategory::where('is_active', '1')->orderBy('name', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();
        $metaData = [
            "title" => "Local Business Directory - Find Trusted Businesses on GujjuTicks",
            "description" => "Explore verified local businesses in your city on GujjuTicks. Find shops, services, professionals, and companies near you with contact details and reviews.",
            "keywords" => "local business directory, business listing, find local businesses, city directory, nearby services, shops near me, GujjuTicks business directory",
            "url" => route('pages.business'),
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
        return view('pages.business.business', ['metaData' => $metaData, 'cities' => $cities, 'categories' => $categories]);
    }

    public function add(Request $request): View
    {
        $categories = PlaceCategory::where('is_active', '1')->orderBy('name', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();
        $metaData = [
            "title" => "Add Your Business - Get Listed in GujjuTicks Business Directory",
            "description" => "List your business for free in our city directory. Increase visibility, attract local customers, and grow your brand online in just a few minutes.",
            "keywords" => "add business, list business online, city business directory, local listing, free business listing, promote business, online directory, business registration",
            "url" => route('pages.business.add')
        ];
        return view('pages.business.add', ['metaData' => $metaData, 'cities' => $cities, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'city_id' => 'required|exists:cities,id',
            'place_category_id' => 'required|exists:place_categories,id',
            'description' => 'required|max:2048',
            'address' => 'required|max:1048',
            'website' => 'nullable|url|max:255',
            'phone' => 'required|numeric|digits_between:10,12',
        ]);

        if ($validator->fails()) {
            return redirect('business/add')->withErrors($validator)->withInput();
        }

        $dataToInsert = $validator->validated();
        $data = [
            'name' => $dataToInsert['name'],
            'city_id' => $dataToInsert['city_id'],
            'place_category_id' => $dataToInsert['place_category_id'],
            'description' => $dataToInsert['description'],
            'address' => $dataToInsert['address'],
            'website' => $dataToInsert['website'],
            'phone' => $dataToInsert['phone']
        ];

        $business = Business::create($data);
        if (!empty($business) && isset($business->id)) {
            $data = [
                'message_tag' => 'msg.new_business_added',
                'user_id' => Auth::id(),
                'extra_id' => $business->id,
            ];
            Notification::create($data);
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
