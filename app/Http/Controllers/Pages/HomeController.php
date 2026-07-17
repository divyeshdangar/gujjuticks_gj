<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
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
            "title" => "GujjuTicks — Software, Tech & AI Products",
            "no_title" => true,
            "description" => 'GujjuTicks builds software, tech products, and AI tools for modern businesses. Explore our products, read insights, and partner with us to ship what you need.',
            "image" => asset('brand/pages/gujjuticks-homepage.png'),
            "url" => route('home'),
            "schema" => [
                "@context" => "https://schema.org",
                "@type" => "Organization",
                "name" => "GujjuTicks",
                "url" => "https://www.gujjuticks.com/",
                "description" => "GujjuTicks is a software company that creates tech products and AI tools.",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "https://www.gujjuticks.com/brand/pages/gujjuticks-home.png"
                ],
                "sameAs" => [
                    "https://www.instagram.com/gujjuticks/",
                    "https://twitter.com/gujjuticks",
                    "https://www.youtube.com/@gujjuticks"
                ]
            ]
        ];
        $dataList = Blog::where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();

        return view('welcome', ['metaData' => $metaData, 'lang' => $this->languages, 'dataList' => $dataList]);
    }
}
