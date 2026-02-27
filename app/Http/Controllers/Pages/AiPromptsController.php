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
     * List AI prompts with category filter and search.
     */
    public function index(Request $request): View
    {
        $metaData = [
            'title' => 'AI Prompts – Quality Prompts by Category | GujjuTicks',
            'description' => 'Browse quality AI prompts by category. Find prompts for writing, coding, marketing, and more. Filter, search, and copy with one click.',
            'keywords' => 'AI prompts, ChatGPT prompts, prompt library, AI writing prompts, prompt categories, copy prompts',
            'url' => route('pages.ai_prompts.list'),
        ];

        $query = AiPrompt::with('category')
            ->active()
            ->searching()
            ->orderBy('id', 'DESC');

        if ($request->filled('category')) {
            $slug = $request->get('category');
            $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug)->active();
            });
        }

        $dataList = $query->paginate(12)->withQueryString();
        $categories = AiPromptCategory::active()->orderBy('sort_order')->orderBy('name')->get();

        $metaData['prev'] = $dataList->previousPageUrl() ?? null;

        return view('pages.ai_prompts.list', [
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
        ];

        if (!empty($dataDetail->image)) {
            $metaData['image'] = URL::asset('images/ai-prompts/' . $dataDetail->image);
        }

        $categories = AiPromptCategory::active()->orderBy('sort_order')->orderBy('name')->get();
        $relatedList = AiPrompt::with('category')
            ->active()
            ->where('id', '!=', $dataDetail->id)
            ->where('ai_prompt_category_id', $dataDetail->ai_prompt_category_id)
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
