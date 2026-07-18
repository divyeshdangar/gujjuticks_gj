<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Support\SitePages;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketingController extends Controller
{
    public function servicesHub(Request $request): View
    {
        $hub = SitePages::get('services.hub');
        $pages = SitePages::get('services.pages', []);

        $items = collect($hub['items'] ?? [])->map(function ($item) use ($pages) {
            $page = $pages[$item['slug']] ?? [];

            return [
                'slug' => $item['slug'],
                'tag' => $item['tag'] ?? '',
                'title' => $item['title'],
                'summary' => $page['lead'] ?? $item['summary'],
                'category' => $page['category'] ?? 'Service',
                'ideal_for' => $page['ideal_for'] ?? null,
                'timeline' => $page['timeline'] ?? null,
                'tools' => $page['tools'] ?? [],
                'highlights' => $page['highlights'] ?? [],
            ];
        })->values()->all();

        $url = route('pages.services');

        return view('pages.marketing.services-index', [
            'hub' => $hub,
            'items' => $items,
            'metaData' => $this->meta(
                $hub['meta_title'],
                $hub['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => 'Services', 'item' => $url],
                ]
            ),
        ]);
    }

    public function servicesShow(Request $request, string $slug): View
    {
        $page = SitePages::page('services', $slug);
        if ($page === null) {
            abort(404);
        }

        $hub = SitePages::get('services.hub');
        $url = route('pages.services.show', ['slug' => $slug]);

        $serviceSiblings = collect($hub['items'] ?? [])
            ->reject(fn ($item) => ($item['slug'] ?? '') === $slug)
            ->take(3)
            ->values();

        return view('pages.marketing.services-show', [
            'slug' => $slug,
            'page' => $page,
            'hubLabel' => $hub['label'],
            'hubRoute' => 'pages.services',
            'serviceSiblings' => $serviceSiblings,
            'metaData' => $this->meta(
                $page['meta_title'],
                $page['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => 'Services', 'item' => route('pages.services')],
                    ['name' => $page['label'], 'item' => $url],
                ]
            ),
        ]);
    }

    public function technologyHub(Request $request): View
    {
        $hub = SitePages::get('technology.hub');
        $pages = SitePages::get('technology.pages', []);

        $items = collect($hub['items'] ?? [])->map(function ($item) use ($pages) {
            $page = $pages[$item['slug']] ?? [];

            return [
                'slug' => $item['slug'],
                'title' => $item['title'],
                'summary' => $page['lead'] ?? $item['summary'],
                'category' => $page['category'] ?? ($item['tag'] ?? ''),
                'best_for' => $page['best_for'] ?? null,
                'tools' => $page['tools'] ?? [],
                'highlights' => $page['highlights'] ?? [],
            ];
        })->values()->all();

        $url = route('pages.technology');

        return view('pages.marketing.technology-index', [
            'hub' => $hub,
            'items' => $items,
            'metaData' => $this->meta(
                $hub['meta_title'],
                $hub['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => 'Technology', 'item' => $url],
                ]
            ),
        ]);
    }

    public function technologyShow(Request $request, string $slug): View
    {
        $page = SitePages::page('technology', $slug);
        if ($page === null) {
            abort(404);
        }

        $hub = SitePages::get('technology.hub');
        $url = route('pages.technology.show', ['slug' => $slug]);

        $related = collect($hub['items'] ?? [])
            ->reject(fn ($item) => ($item['slug'] ?? '') === $slug)
            ->take(3)
            ->values();

        return view('pages.marketing.technology-show', [
            'slug' => $slug,
            'page' => $page,
            'related' => $related,
            'metaData' => $this->meta(
                $page['meta_title'],
                $page['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => 'Technology', 'item' => route('pages.technology')],
                    ['name' => $page['label'], 'item' => $url],
                ]
            ),
        ]);
    }

    public function about(Request $request): View
    {
        return $this->renderCompanyPage('about', 'pages.about', 'pages.marketing.about', 'About');
    }

    public function howWeWork(Request $request): View
    {
        return $this->renderCompanyPage('how_we_work', 'pages.how-we-work', 'pages.marketing.how-we-work', 'How we work');
    }

    public function industries(Request $request): View
    {
        return $this->renderCompanyPage('industries', 'pages.industries', 'pages.marketing.industries', 'Industries');
    }

    public function industriesShow(Request $request, string $slug): View
    {
        $page = SitePages::page('industries', $slug);
        if ($page === null) {
            abort(404);
        }

        $hub = SitePages::section('industries');
        $url = route('pages.industries.show', ['slug' => $slug]);

        $siblings = collect($hub['industries'] ?? [])
            ->reject(fn ($item) => ($item['slug'] ?? '') === $slug)
            ->take(3)
            ->values();

        return view('pages.marketing.industries-show', [
            'slug' => $slug,
            'page' => $page,
            'siblings' => $siblings,
            'groupLabel' => ($hub['groups'][$page['group'] ?? ''] ?? null) ?: ($page['group_label'] ?? 'Industry'),
            'metaData' => $this->meta(
                $page['meta_title'],
                $page['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => 'Industries', 'item' => route('pages.industries')],
                    ['name' => $page['label'], 'item' => $url],
                ]
            ),
        ]);
    }

    public function faq(Request $request): View
    {
        return $this->renderCompanyPage('faq', 'pages.faq', 'pages.marketing.faq', 'FAQ');
    }

    public function careers(Request $request): View
    {
        return $this->renderCompanyPage('careers', 'pages.careers', 'pages.marketing.careers', 'Careers');
    }

    public function workHub(Request $request): View
    {
        $hub = SitePages::get('work.hub');
        $items = collect(SitePages::get('work.pages', []))->map(function ($item, $slug) {
            return [
                'slug' => $slug,
                'title' => $item['heading'],
                'summary' => $item['lead'],
                'industry' => $item['industry'] ?? $item['label'],
                'duration' => $item['duration'] ?? null,
                'stack' => $item['stack'] ?? [],
                'highlights' => $item['highlights'] ?? [],
            ];
        })->values()->all();

        $url = route('pages.work');

        return view('pages.marketing.work-index', [
            'hub' => $hub,
            'items' => $items,
            'metaData' => $this->meta(
                $hub['meta_title'],
                $hub['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => 'Work', 'item' => $url],
                ]
            ),
        ]);
    }

    public function workShow(Request $request, string $slug): View
    {
        $page = SitePages::page('work', $slug);
        if ($page === null) {
            abort(404);
        }

        $url = route('pages.work.show', ['slug' => $slug]);

        $related = collect(SitePages::get('work.hub.page_order', []))
            ->reject(fn ($key) => $key === $slug)
            ->take(2)
            ->map(function ($key) {
                $item = SitePages::page('work', $key);
                if ($item === null) {
                    return null;
                }

                return array_merge($item, ['slug' => $key]);
            })
            ->filter()
            ->values();

        return view('pages.marketing.work-show', [
            'slug' => $slug,
            'page' => $page,
            'related' => $related,
            'metaData' => $this->meta(
                $page['meta_title'],
                $page['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => 'Work', 'item' => route('pages.work')],
                    ['name' => $page['heading'], 'item' => $url],
                ]
            ),
        ]);
    }

    private function renderHub(string $section, string $routeName): View
    {
        $hub = SitePages::get("{$section}.hub");
        $url = route($routeName);

        return view('pages.marketing.hub', [
            'section' => $section,
            'hub' => $hub,
            'items' => $hub['items'],
            'itemRoute' => $routeName . '.show',
            'metaData' => $this->meta(
                $hub['meta_title'],
                $hub['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => $hub['label'], 'item' => $url],
                ]
            ),
        ]);
    }

    private function renderDetail(string $section, string $slug, string $routeName, string $hubRoute): View
    {
        $page = SitePages::page($section, $slug);
        if ($page === null) {
            abort(404);
        }

        $hub = SitePages::get("{$section}.hub");
        $url = route($routeName, ['slug' => $slug]);

        $siblings = collect($hub['items'] ?? [])
            ->reject(fn ($item) => ($item['slug'] ?? '') === $slug)
            ->take(3)
            ->values()
            ->all();

        return view('pages.marketing.detail', [
            'section' => $section,
            'slug' => $slug,
            'page' => $page,
            'hubLabel' => $hub['label'],
            'hubRoute' => $hubRoute,
            'itemRoute' => $hubRoute . '.show',
            'siblings' => $siblings,
            'metaData' => $this->meta(
                $page['meta_title'],
                $page['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => $hub['label'], 'item' => route($hubRoute)],
                    ['name' => $page['label'], 'item' => $url],
                ]
            ),
        ]);
    }

    private function renderCompanyPage(string $configKey, string $routeName, string $view, string $crumbLabel): View
    {
        $page = SitePages::section($configKey);
        $url = route($routeName);

        return view($view, [
            'page' => $page,
            'metaData' => $this->meta(
                $page['meta_title'],
                $page['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => $crumbLabel, 'item' => $url],
                ]
            ),
        ]);
    }

    private function meta(string $title, string $description, string $url, array $crumbs): array
    {
        $list = [];
        foreach ($crumbs as $i => $crumb) {
            $list[] = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $crumb['name'],
                'item' => $crumb['item'],
            ];
        }

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => 'GujjuTicks, custom apps, websites, custom software, ' . strtolower($title),
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'image_alt' => $title,
            'url' => $url,
            'og_type' => 'website',
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
                        'itemListElement' => $list,
                    ],
                ],
            ],
        ];
    }
}
