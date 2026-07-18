<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketingController extends Controller
{
    public function servicesHub(Request $request): View
    {
        $hub = config('site_pages.services.hub');
        $pages = config('site_pages.services.pages', []);

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
        $pages = config('site_pages.services.pages', []);
        if (! isset($pages[$slug])) {
            abort(404);
        }

        $page = $pages[$slug];
        $hub = config('site_pages.services.hub');
        $url = route('pages.services.show', ['slug' => $slug]);

        return view('pages.marketing.services-show', [
            'slug' => $slug,
            'page' => $page,
            'hubLabel' => $hub['label'],
            'hubRoute' => 'pages.services',
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
        $hub = config('site_pages.technology.hub');
        $pages = config('site_pages.technology.pages', []);

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
        $pages = config('site_pages.technology.pages', []);
        if (! isset($pages[$slug])) {
            abort(404);
        }

        $page = $pages[$slug];
        $url = route('pages.technology.show', ['slug' => $slug]);

        return view('pages.marketing.technology-show', [
            'slug' => $slug,
            'page' => $page,
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
        $page = config('site_pages.about');
        $url = route('pages.about');

        return view('pages.marketing.about', [
            'page' => $page,
            'metaData' => $this->meta(
                $page['meta_title'],
                $page['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => 'About', 'item' => $url],
                ]
            ),
        ]);
    }

    public function workHub(Request $request): View
    {
        $hub = config('site_pages.work.hub');
        $items = collect(config('site_pages.work.pages'))->map(function ($item, $slug) {
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
        $pages = config('site_pages.work.pages', []);
        if (! isset($pages[$slug])) {
            abort(404);
        }

        $page = $pages[$slug];
        $url = route('pages.work.show', ['slug' => $slug]);

        return view('pages.marketing.work-show', [
            'slug' => $slug,
            'page' => $page,
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

    public function privacy(Request $request): View
    {
        return $this->renderLegal('privacy', 'pages.privacy');
    }

    public function terms(Request $request): View
    {
        return $this->renderLegal('terms', 'pages.terms');
    }

    private function renderHub(string $section, string $routeName): View
    {
        $hub = config("site_pages.{$section}.hub");
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
        $pages = config("site_pages.{$section}.pages", []);
        if (! isset($pages[$slug])) {
            abort(404);
        }

        $page = $pages[$slug];
        $hub = config("site_pages.{$section}.hub");
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

    private function renderLegal(string $key, string $routeName): View
    {
        $page = config("site_pages.legal.{$key}");
        $url = route($routeName);

        return view('pages.marketing.legal', [
            'page' => $page,
            'metaData' => $this->meta(
                $page['meta_title'],
                $page['meta_description'],
                $url,
                [
                    ['name' => 'Home', 'item' => route('home')],
                    ['name' => $page['heading'], 'item' => $url],
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
