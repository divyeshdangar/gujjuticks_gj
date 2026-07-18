<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PagesController extends Controller
{
    public function view(Request $request, string $slug): View|RedirectResponse
    {
        $dataDetail = Pages::query()
            ->where('slug', $slug)
            ->where('status', '1')
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
            : 'Page';
        $description = trim((string) ($dataDetail->meta_description ?? '')) !== ''
            ? $dataDetail->meta_description
            : (trim(strip_tags((string) ($dataDetail->description ?? ''))) !== ''
                ? Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags((string) $dataDetail->description))), 160)
                : $title . ' — practical pages and guides from GujjuTicks.');

        $url = route('p.pages', ['slug' => $dataDetail->slug]);
        $image = asset('brand/pages/gujjuticks-homepage.png');
        if (! empty($dataDetail->image) && $dataDetail->image !== 'default.png') {
            $image = asset('images/pages/' . $dataDetail->image);
        }

        $metaData = [
            'title' => $title . ' | GujjuTicks',
            'description' => $description,
            'keywords' => 'GujjuTicks, ' . strtolower($title),
            'url' => $url,
            'image' => $image,
            'image_alt' => $title,
            'og_type' => 'article',
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'schema' => [
                '@context' => 'https://schema.org',
                '@graph' => [
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
                            [
                                '@type' => 'ListItem',
                                'position' => 1,
                                'name' => 'Home',
                                'item' => route('home'),
                            ],
                            [
                                '@type' => 'ListItem',
                                'position' => 2,
                                'name' => $title,
                                'item' => $url,
                            ],
                        ],
                    ],
                ],
            ],
        ];

        if (! empty($dataDetail->updated_at)) {
            $metaData['modified_time'] = $dataDetail->updated_at->toAtomString();
        }
        if (! empty($dataDetail->created_at)) {
            $metaData['published_time'] = $dataDetail->created_at->toAtomString();
        }

        return view('pages.p.view', [
            'dataDetail' => $dataDetail,
            'metaData' => $metaData,
        ]);
    }
}
