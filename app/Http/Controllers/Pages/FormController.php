<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\ContactUs;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function show(Request $request): View
    {
        $url = route('form.contact');
        $title = 'Contact GujjuTicks — Custom Apps, Websites & Software';
        $description = 'Contact GujjuTicks to discuss a custom app, website, or software project. We help startups and businesses design, build, and launch digital products.';

        $metaData = [
            'title' => $title,
            'description' => $description,
            'keywords' => 'contact GujjuTicks, custom app development, website development, custom software, startup software partner',
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'image_alt' => 'Contact GujjuTicks',
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
                    ],
                    [
                        '@type' => 'ContactPage',
                        '@id' => $url . '#webpage',
                        'url' => $url,
                        'name' => $title,
                        'description' => $description,
                        'isPartOf' => [
                            '@type' => 'WebSite',
                            'name' => 'GujjuTicks',
                            'url' => 'https://www.gujjuticks.com/',
                        ],
                        'about' => ['@id' => 'https://www.gujjuticks.com/#organization'],
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
                                'name' => 'Contact',
                                'item' => $url,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return view('pages.form.contact', ['metaData' => $metaData]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|digits:10',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('contact-us')->withErrors($validator)->withInput();
        }

        $dataToInsert = $validator->validated();
        $dataDetail = new ContactUs;
        $dataDetail->user_id = Auth::id();
        $dataDetail->message = $dataToInsert['message'];
        $dataDetail->phone = $dataToInsert['phone'];
        $dataDetail->email = $dataToInsert['email'];
        $dataDetail->name = $dataToInsert['name'];
        $dataDetail->save();

        $message = [
            'message' => [
                'type' => 'success',
                'title' => __('dashboard.great'),
                'description' => __('dashboard.details_submitted'),
            ],
        ];
        return redirect()->route('home')->with($message);
    }
}
