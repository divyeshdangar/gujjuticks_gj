<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\PlaceCategory;
use App\Models\Blog;

class HomeController extends Controller
{
    public $languages = [
        'e' => 'English',
        'h' => 'हिन्दी',
        'g' => 'ગુજરાતી'
    ];
    public function show(Request $request): View
    {
        $metaData = [
            "title" => "GujjuTicks - ગુજ્જુટિકસ | Made In Gujarat",
            "no_title" => true,
            "description" => 'Discover affordable and free essential services tailored for the Gujarati community at GujjuTicks.com. From education and social media to work management and daily task, access what you need at unbeatable prices or completely free. Join us in empowering the Gujarati community today!',
            "image" => asset('brand/pages/gujjuticks-homepage.png'),
            "url" => route('home'),
            "schema" => [
                "@context" => "https://schema.org",
                "@type" => "WebSite",
                "name" => "GujjuTicks",
                "url" => "https://www.gujjuticks.com/",
                "description" => "GujjuTicks is your one-stop portal for Gujarati news, inspiring quotes, blogs, and trending stories - updated daily.",
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
                // "potentialAction" => [
                //     "@type" => "SearchAction",
                //     "target" => "https://www.gujjuticks.com/search?q={search_term_string}",
                //     "query-input" => "required name=search_term_string"
                // ],
                "mainEntity" => [
                    "@type" => "CollectionPage",
                    "name" => "GujjuTicks Home",
                    "about" => [
                        [
                            "@type" => "Thing",
                            "name" => "Gujarati News"
                        ],
                        [
                            "@type" => "Thing",
                            "name" => "Motivational Quotes"
                        ],
                        [
                            "@type" => "Thing",
                            "name" => "Blogs"
                        ],
                        [
                            "@type" => "Thing",
                            "name" => "Festivals & Culture"
                        ],
                        [
                            "@type" => "Thing",
                            "name" => "Social Media Trends"
                        ]
                    ]
                ]
            ]
        ];
        $categories = PlaceCategory::withCount('businesses')->where('is_active', '1')->orderBy('name')->limit(8)->get();
        $dataList = Blog::where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();

        return view('welcome', ['metaData' => $metaData, 'lang' => $this->languages, 'categories' => $categories, 'dataList' => $dataList]);
    }
}
