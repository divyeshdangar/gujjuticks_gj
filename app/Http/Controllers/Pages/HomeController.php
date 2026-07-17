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
        $url = route('home');
        $title = 'GujjuTicks — Custom Apps, Websites & Software';
        $description = 'GujjuTicks is a software startup building custom apps, websites, and business software for startups and growing teams. Clear scope, steady delivery, and launches you can run.';

        $metaData = [
            'title' => $title,
            'description' => $description,
            'keywords' => 'GujjuTicks, custom app development, website development, custom software, software startup, MVP development, business software India',
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'image_alt' => 'GujjuTicks — custom apps, websites and software',
            'url' => $url,
            'og_type' => 'website',
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'schema' => [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'Organization',
                        '@id' => 'https://www.gujjuticks.com/#organization',
                        'name' => 'GujjuTicks',
                        'url' => 'https://www.gujjuticks.com/',
                        'description' => 'GujjuTicks is a software startup that provides custom apps, websites, and software development for startups and businesses.',
                        'email' => 'info@gujjuticks.com',
                        'telephone' => '+91-7600-126800',
                        'address' => [
                            '@type' => 'PostalAddress',
                            'addressRegion' => 'Gujarat',
                            'addressCountry' => 'IN',
                        ],
                        'logo' => [
                            '@type' => 'ImageObject',
                            'url' => asset('brand/full-logo-black.png'),
                        ],
                        'sameAs' => [
                            'https://www.instagram.com/gujjuticks/',
                            'https://twitter.com/gujjuticks',
                            'https://www.youtube.com/@gujjuticks',
                        ],
                        'knowsAbout' => [
                            'Custom application development',
                            'Website development',
                            'Custom software',
                            'MVP development',
                        ],
                    ],
                    [
                        '@type' => 'WebSite',
                        '@id' => 'https://www.gujjuticks.com/#website',
                        'url' => 'https://www.gujjuticks.com/',
                        'name' => 'GujjuTicks',
                        'publisher' => ['@id' => 'https://www.gujjuticks.com/#organization'],
                    ],
                    [
                        '@type' => 'WebPage',
                        '@id' => $url . '#webpage',
                        'url' => $url,
                        'name' => $title,
                        'description' => $description,
                        'isPartOf' => ['@id' => 'https://www.gujjuticks.com/#website'],
                        'about' => ['@id' => 'https://www.gujjuticks.com/#organization'],
                    ],
                    [
                        '@type' => 'ItemList',
                        'name' => 'GujjuTicks services',
                        'itemListElement' => [
                            [
                                '@type' => 'ListItem',
                                'position' => 1,
                                'name' => 'Custom apps',
                                'description' => 'Mobile and web applications tailored to your workflows.',
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 2,
                                'name' => 'Websites',
                                'description' => 'Marketing and product websites that convert and stay easy to update.',
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 3,
                                'name' => 'Custom software',
                                'description' => 'Business systems and integrations that automate operations.',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $dataList = Blog::with(['user', 'category'])
            ->where('status', '1')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        return view('welcome', [
            'metaData' => $metaData,
            'lang' => $this->languages,
            'dataList' => $dataList,
        ]);
    }
}
