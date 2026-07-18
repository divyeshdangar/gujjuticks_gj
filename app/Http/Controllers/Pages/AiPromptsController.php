<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\AiPrompt;
use App\Models\AiPromptCategory;
use App\Models\AiPromptComment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use URL;

class AiPromptsController extends Controller
{
    /**
     * List AI prompts with search. Old ?category=slug is redirected to /ai-prompts/slug.
     */
    public function index(Request $request): View|\Illuminate\Http\RedirectResponse
    {
        if ($request->filled('category')) {
            return redirect()->route('pages.ai_prompts.category', [
                'slug' => $request->get('category'),
            ], 301)->withQueryString();
        }

        $metaData = [
            'title' => 'AI Prompts by Category – Ready-to-Use Prompt Library | GujjuTicks',
            'description' => 'Browse predefined AI prompts by category. Copy ready-made prompts for writing, coding, marketing, and more — so you can finish tasks faster without starting from scratch.',
            'keywords' => 'AI prompts, ChatGPT prompts, prompt library, prompt categories, ready-made prompts, copy prompts',
            'url' => route('pages.ai_prompts.list'),
            'image' => asset('brand/pages/gujjuticks-homepage.png'),
            'image_alt' => 'AI Prompts library',
            'robots' => $request->filled('search')
                ? 'noindex, follow'
                : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
        ];

        $query = AiPrompt::with('category')
            ->active()
            ->whereNotNull('slug')
            ->searching()
            ->orderBy('id', 'DESC');

        $dataList = $query->paginate(12)->withQueryString();
        $categories = AiPromptCategory::active()->orderBy('sort_order')->orderBy('name')->get();

        $metaData['prev'] = $dataList->previousPageUrl();
        $metaData['next'] = $dataList->nextPageUrl();
        $metaData['schema'] = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'CollectionPage',
                    '@id' => $metaData['url'] . '#webpage',
                    'url' => $metaData['url'],
                    'name' => $metaData['title'],
                    'description' => $metaData['description'],
                ],
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                        ['@type' => 'ListItem', 'position' => 2, 'name' => 'AI Prompts', 'item' => $metaData['url']],
                    ],
                ],
            ],
        ];

        return view('pages.ai_prompts.list', [
            'metaData' => $metaData,
            'dataList' => $dataList,
            'categories' => $categories,
            'searchTerm' => $request->get('search'),
            'stats' => [
                'prompts' => AiPrompt::active()->whereNotNull('slug')->count(),
                'categories' => $categories->count(),
                'copies' => (int) AiPrompt::active()->sum('copy_count'),
            ],
        ]);
    }

    /**
     * Category page: AI prompts in a single category (separate URL for SEO).
     */
    public function category(Request $request, string $slug): View|\Illuminate\Http\RedirectResponse
    {
        $category = AiPromptCategory::where('slug', $slug)->active()->first();

        if (!$category) {
            return redirect()->route('pages.ai_prompts.list')->with('message', [
                'type' => 'error',
                'title' => __('dashboard.bad'),
                'description' => __('dashboard.no_record_found'),
            ]);
        }

        $metaData = [
            'title' => $category->name . ' AI Prompts – Ready-to-Use by Category | GujjuTicks',
            'no_title' => true,
            'description' => $category->meta_description ?? $category->description ?? 'Browse ready-made ' . $category->name . ' AI prompts. Open, copy, and reuse predefined prompts to finish tasks faster.',
            'keywords' => $category->meta_keywords ?? 'AI prompts, ' . $category->name . ' prompts, ChatGPT prompts, ready-made prompts, ' . $category->name,
            'url' => route('pages.ai_prompts.category', ['slug' => $category->slug]),
            'robots' => $request->filled('search')
                ? 'noindex, follow'
                : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
        ];

        if (!empty($category->image)) {
            $metaData['image'] = URL::asset('images/ai-prompt-categories/' . $category->image);
        }

        $query = AiPrompt::with('category')
            ->active()
            ->where('ai_prompt_category_id', $category->id)
            ->whereNotNull('slug')
            ->searching()
            ->orderBy('id', 'DESC');

        $dataList = $query->paginate(12)->withQueryString();
        $categories = AiPromptCategory::active()->orderBy('sort_order')->orderBy('name')->get();

        $metaData['prev'] = $dataList->previousPageUrl();
        $metaData['next'] = $dataList->nextPageUrl();

        // JSON-LD: CollectionPage + ItemList for category page
        $baseUrl = rtrim(config('app.url'), '/');
        $categoryUrl = $baseUrl . '/ai-prompts/' . $category->slug;
        $listItems = $dataList->getCollection()->take(20)->map(function ($prompt) use ($baseUrl) {
            return [
                '@type' => 'ListItem',
                'position' => 1,
                'url' => $baseUrl . '/ai-prompt/' . $prompt->slug,
                'name' => $prompt->title,
            ];
        })->values()->all();
        foreach (array_keys($listItems) as $i) {
            $listItems[$i]['position'] = $i + 1;
        }

        $metaData['schema'] = [
            '@context' => 'https://schema.org',
            '@type' => 'CollectionPage',
            'name' => $category->name . ' AI Prompts',
            'description' => $metaData['description'],
            'url' => $categoryUrl,
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'GujjuTicks',
                'url' => $baseUrl,
            ],
            'mainEntity' => [
                '@type' => 'ItemList',
                'name' => $category->name . ' AI Prompts',
                'numberOfItems' => $dataList->total(),
                'itemListElement' => $listItems,
            ],
        ];

        return view('pages.ai_prompts.category', [
            'category' => $category,
            'metaData' => $metaData,
            'dataList' => $dataList,
            'categories' => $categories,
        ]);
    }

    /**
     * Show a single AI prompt detail page (shareable by slug).
     */
    public function show(Request $request, string $slug): View|\Illuminate\Http\RedirectResponse
    {
        $dataDetail = AiPrompt::with(['category', 'comments.user'])
            ->where('slug', $slug)
            ->active()
            ->first();

        if (!$dataDetail) {
            return redirect()->route('pages.ai_prompts.list')->with('message', [
                'type' => 'error',
                'title' => __('dashboard.bad'),
                'description' => __('dashboard.no_record_found'),
            ]);
        }

        $metaData = [
            'title' => $dataDetail->title . ' - GujjuTicks AI Prompts',
            'no_title' => true,
            'description' => $dataDetail->meta_description ?? $dataDetail->description ?? Str::limit(strip_tags($dataDetail->prompt), 160),
            'keywords' => $dataDetail->meta_keywords ?? 'AI prompt, ' . $dataDetail->title,
            'url' => route('pages.ai_prompts.detail', ['slug' => $dataDetail->slug]),
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'image' => ! empty($dataDetail->image)
                ? URL::asset('images/ai-prompts/' . $dataDetail->image)
                : asset('brand/pages/gujjuticks-homepage.png'),
            'image_alt' => $dataDetail->title,
            'schema' => [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'WebPage',
                        '@id' => route('pages.ai_prompts.detail', ['slug' => $dataDetail->slug]) . '#webpage',
                        'url' => route('pages.ai_prompts.detail', ['slug' => $dataDetail->slug]),
                        'name' => $dataDetail->title,
                        'description' => $dataDetail->meta_description ?? $dataDetail->description ?? Str::limit(strip_tags((string) $dataDetail->prompt), 160),
                    ],
                    [
                        '@type' => 'BreadcrumbList',
                        'itemListElement' => array_values(array_filter([
                            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')],
                            ['@type' => 'ListItem', 'position' => 2, 'name' => 'AI Prompts', 'item' => route('pages.ai_prompts.list')],
                            $dataDetail->category
                                ? [
                                    '@type' => 'ListItem',
                                    'position' => 3,
                                    'name' => $dataDetail->category->name,
                                    'item' => route('pages.ai_prompts.category', ['slug' => $dataDetail->category->slug]),
                                ]
                                : null,
                            [
                                '@type' => 'ListItem',
                                'position' => $dataDetail->category ? 4 : 3,
                                'name' => $dataDetail->title,
                                'item' => route('pages.ai_prompts.detail', ['slug' => $dataDetail->slug]),
                            ],
                        ])),
                    ],
                ],
            ],
        ];

        if (!empty($dataDetail->image)) {
            $metaData['image'] = URL::asset('images/ai-prompts/' . $dataDetail->image);
        }

        $categories = AiPromptCategory::active()->orderBy('sort_order')->orderBy('name')->get();
        $relatedList = AiPrompt::with('category')
            ->active()
            ->where('id', '!=', $dataDetail->id)
            ->where('ai_prompt_category_id', $dataDetail->ai_prompt_category_id)
            ->whereNotNull('slug')
            ->limit(4)
            ->get();

        return view('pages.ai_prompts.detail', [
            'dataDetail' => $dataDetail,
            'metaData' => $metaData,
            'categories' => $categories,
            'relatedList' => $relatedList,
        ]);
    }

    /**
     * Store a comment on a prompt (logged-in users only).
     */
    public function storeComment(Request $request, string $slug): \Illuminate\Http\RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', [
                'type' => 'error',
                'title' => 'Login required',
                'description' => 'You must be logged in to add a comment.',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|min:3|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pages.ai_prompts.detail', ['slug' => $slug])
                ->withErrors($validator)
                ->withInput();
        }

        $prompt = AiPrompt::where('slug', $slug)->active()->first();
        if (!$prompt) {
            return redirect()->route('pages.ai_prompts.list')->with('message', [
                'type' => 'error',
                'title' => 'Error',
                'description' => 'Prompt not found.',
            ]);
        }

        AiPromptComment::create([
            'ai_prompt_id' => $prompt->id,
            'user_id' => Auth::id(),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->route('pages.ai_prompts.detail', ['slug' => $slug])->with('message', [
            'type' => 'success',
            'title' => 'Thank you',
            'description' => 'Your comment has been posted.',
        ]);
    }

    /**
     * Increment copy count when user copies a prompt (AJAX).
     */
    public function copy(Request $request, string $uniqueId): JsonResponse
    {
        $prompt = AiPrompt::where('unique_id', $uniqueId)->active()->first();

        if (!$prompt) {
            return response()->json(['success' => false, 'message' => 'Prompt not found'], 404);
        }

        $prompt->incrementCopyCount();

        return response()->json([
            'success' => true,
            'copy_count' => $prompt->fresh()->copy_count,
        ]);
    }
}
