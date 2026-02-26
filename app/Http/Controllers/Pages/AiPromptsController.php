<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\AiPrompt;
use App\Models\AiPromptCategory;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

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
