<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\UpdateAnswer;
use App\Models\UpdateCategory;
use App\Models\UpdateComment;
use App\Models\UpdatePollOption;
use App\Models\UpdatePollVote;
use App\Models\UpdatePost;
use App\Models\UpdateReaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UpdatesController extends Controller
{
    public function index(Request $request): View
    {
        $metaData = [
            'title' => 'City Updates Feed | GujjuTicks',
            'description' => 'Post and discover city-wise and category-wise updates on GujjuTicks.',
            'keywords' => 'city updates, local updates, community feed, public updates',
            'url' => route('pages.updates.list'),
        ];

        $query = UpdatePost::with(['city', 'category', 'creator'])
            ->withCount(['comments', 'reactions'])
            ->published()
            ->visibleFor(Auth::id())
            ->orderBy('id', 'DESC');

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->integer('city_id'));
        }
        if ($request->filled('category_id')) {
            $query->where('update_category_id', $request->integer('category_id'));
        }
        if ($request->filled('type')) {
            $query->where('type', $request->get('type'));
        }
        if ($request->filled('search')) {
            $term = $request->get('search');
            $query->where(function ($inner) use ($term) {
                $inner
                    ->where('title', 'LIKE', '%' . $term . '%')
                    ->orWhere('description', 'LIKE', '%' . $term . '%');
            });
        }

        $dataList = $query->paginate(12)->withQueryString();

        return view('pages.updates.list', [
            'metaData' => $metaData,
            'dataList' => $dataList,
            'cityData' => City::orderBy('name')->get(),
            'categoryData' => UpdateCategory::active()->orderBy('sort_order')->orderBy('name')->get(),
            'types' => $this->types(),
        ]);
    }

    public function show(Request $request, string $slug): View|RedirectResponse
    {
        $dataDetail = UpdatePost::with([
            'city',
            'category',
            'creator',
            'pollOptions',
            'answers.user',
            'comments.user',
            'reactions',
        ])
            ->where('slug', $slug)
            ->published()
            ->first();

        if (!$dataDetail) {
            return redirect()->route('pages.updates.list')->with('message', [
                'type' => 'error',
                'title' => __('dashboard.bad'),
                'description' => __('dashboard.no_record_found'),
            ]);
        }

        $viewer = Auth::user();
        $hasAccess = $this->canAccessUpdate($dataDetail, $viewer?->id, $viewer?->is_admin());

        $metaData = [
            'title' => $dataDetail->title . ' | GujjuTicks Updates',
            'description' => $dataDetail->description ?: 'Community update on GujjuTicks',
            'url' => route('pages.updates.detail', ['slug' => $dataDetail->slug]),
        ];

        return view('pages.updates.detail', [
            'metaData' => $metaData,
            'dataDetail' => $dataDetail,
            'hasAccess' => $hasAccess,
            'isGuest' => !Auth::check(),
        ]);
    }

    public function create(Request $request): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $metaData = [
            'title' => 'Post New Update',
            'description' => 'Create city-wise community update',
            'url' => route('pages.updates.create'),
        ];

        return view('pages.updates.form', [
            'metaData' => $metaData,
            'dataDetail' => null,
            'cityData' => City::orderBy('name')->get(),
            'categoryData' => UpdateCategory::active()->orderBy('sort_order')->orderBy('name')->get(),
            'types' => $this->types(),
            'privacyOptions' => [UpdatePost::PRIVACY_PUBLIC, UpdatePost::PRIVACY_PRIVATE],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validator = $this->validateUpdate($request);
        if ($validator->fails()) {
            return redirect()->route('pages.updates.create')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $update = DB::transaction(function () use ($request, $validated) {
            $update = new UpdatePost();
            $this->fillUpdateFields($update, $validated, $request);
            $update->created_by = Auth::id();
            $update->status = UpdatePost::STATUS_ACTIVE;
            $update->save();

            $this->syncTypeSpecificData($update, $validated);
            return $update;
        });

        return redirect()->route('pages.updates.detail', ['slug' => $update->slug])->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Update posted successfully.',
        ]);
    }

    public function edit(Request $request, string $slug): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $dataDetail = UpdatePost::with('pollOptions')->where('slug', $slug)->first();
        if (!$dataDetail) {
            return redirect()->route('pages.updates.list');
        }

        if ((int) $dataDetail->created_by !== (int) Auth::id()) {
            return redirect()->route('pages.updates.detail', ['slug' => $slug])->with('message', [
                'type' => 'error',
                'title' => __('dashboard.bad'),
                'description' => 'You can edit only your own updates.',
            ]);
        }

        $metaData = [
            'title' => 'Edit Update',
            'description' => 'Modify your update',
            'url' => route('pages.updates.edit', ['slug' => $dataDetail->slug]),
        ];

        return view('pages.updates.form', [
            'metaData' => $metaData,
            'dataDetail' => $dataDetail,
            'cityData' => City::orderBy('name')->get(),
            'categoryData' => UpdateCategory::active()->orderBy('sort_order')->orderBy('name')->get(),
            'types' => $this->types(),
            'privacyOptions' => [UpdatePost::PRIVACY_PUBLIC, UpdatePost::PRIVACY_PRIVATE],
        ]);
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $dataDetail = UpdatePost::where('slug', $slug)->first();
        if (!$dataDetail) {
            return redirect()->route('pages.updates.list');
        }
        if ((int) $dataDetail->created_by !== (int) Auth::id()) {
            return redirect()->route('pages.updates.detail', ['slug' => $slug]);
        }

        $validator = $this->validateUpdate($request, $dataDetail->id);
        if ($validator->fails()) {
            return redirect()->route('pages.updates.edit', ['slug' => $slug])->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();

        DB::transaction(function () use ($request, $validated, $dataDetail) {
            $this->fillUpdateFields($dataDetail, $validated, $request);
            $dataDetail->save();
            $this->syncTypeSpecificData($dataDetail, $validated, true);
        });

        return redirect()->route('pages.updates.detail', ['slug' => $dataDetail->slug])->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Update edited successfully.',
        ]);
    }

    public function delete(Request $request, string $slug): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $dataDetail = UpdatePost::where('slug', $slug)->first();
        if (!$dataDetail) {
            return redirect()->route('pages.updates.list');
        }
        if ((int) $dataDetail->created_by !== (int) Auth::id()) {
            return redirect()->route('pages.updates.detail', ['slug' => $slug]);
        }

        $dataDetail->status = UpdatePost::STATUS_DELETED;
        $dataDetail->save();
        $dataDetail->delete();

        return redirect()->route('pages.updates.list')->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Update deleted successfully.',
        ]);
    }

    public function comment(Request $request, string $slug): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', [
                'type' => 'error',
                'title' => 'Login required',
                'description' => 'You must be logged in to comment.',
            ]);
        }

        $dataDetail = UpdatePost::where('slug', $slug)->published()->first();
        if (!$dataDetail || !$this->canAccessUpdate($dataDetail, Auth::id(), Auth::user()?->is_admin())) {
            return redirect()->route('pages.updates.list');
        }

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|min:2|max:2000',
        ]);
        if ($validator->fails()) {
            return redirect()->route('pages.updates.detail', ['slug' => $slug])->withErrors($validator)->withInput();
        }

        UpdateComment::create([
            'update_post_id' => $dataDetail->id,
            'user_id' => Auth::id(),
            'comment' => $request->input('comment'),
            'status' => UpdateComment::STATUS_ACTIVE,
        ]);

        return redirect()->route('pages.updates.detail', ['slug' => $slug])->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Comment posted.',
        ]);
    }

    public function updateComment(Request $request, int $id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $comment = UpdateComment::with('post')->find($id);
        if (!$comment || !$comment->post) {
            return redirect()->route('pages.updates.list');
        }

        $isAllowed = ((int) $comment->user_id === (int) Auth::id()) || Auth::user()?->is_admin();
        if (!$isAllowed) {
            return redirect()->route('pages.updates.detail', ['slug' => $comment->post->slug]);
        }

        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|min:2|max:2000',
        ]);
        if ($validator->fails()) {
            return redirect()->route('pages.updates.detail', ['slug' => $comment->post->slug])->withErrors($validator)->withInput();
        }

        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->route('pages.updates.detail', ['slug' => $comment->post->slug])->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Comment updated.',
        ]);
    }

    public function deleteComment(Request $request, int $id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $comment = UpdateComment::with('post')->find($id);
        if (!$comment || !$comment->post) {
            return redirect()->route('pages.updates.list');
        }

        $isAllowed = ((int) $comment->user_id === (int) Auth::id()) || Auth::user()?->is_admin();
        if (!$isAllowed) {
            return redirect()->route('pages.updates.detail', ['slug' => $comment->post->slug]);
        }

        $comment->status = UpdateComment::STATUS_DELETED;
        $comment->save();
        $comment->delete();

        return redirect()->route('pages.updates.detail', ['slug' => $comment->post->slug])->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Comment deleted.',
        ]);
    }

    public function reportComment(Request $request, int $id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $comment = UpdateComment::with('post')->find($id);
        if (!$comment || !$comment->post) {
            return redirect()->route('pages.updates.list');
        }

        $comment->status = UpdateComment::STATUS_REPORTED;
        $comment->reported_by = Auth::id();
        $comment->save();

        return redirect()->route('pages.updates.detail', ['slug' => $comment->post->slug])->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Comment reported.',
        ]);
    }

    public function react(Request $request, string $slug): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $dataDetail = UpdatePost::where('slug', $slug)->published()->first();
        if (!$dataDetail || !$this->canAccessUpdate($dataDetail, Auth::id(), Auth::user()?->is_admin())) {
            return redirect()->route('pages.updates.list');
        }

        $validator = Validator::make($request->all(), [
            'reaction' => 'nullable|string|max:32',
        ]);
        if ($validator->fails()) {
            return redirect()->route('pages.updates.detail', ['slug' => $slug]);
        }

        $reactionValue = $request->input('reaction', 'like');
        $reaction = UpdateReaction::where('update_post_id', $dataDetail->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($reaction) {
            $reaction->reaction = $reactionValue;
            $reaction->save();
        } else {
            UpdateReaction::create([
                'update_post_id' => $dataDetail->id,
                'user_id' => Auth::id(),
                'reaction' => $reactionValue,
            ]);
        }

        return redirect()->route('pages.updates.detail', ['slug' => $slug]);
    }

    public function vote(Request $request, string $slug): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $dataDetail = UpdatePost::with('pollOptions')->where('slug', $slug)->published()->first();
        if (!$dataDetail || $dataDetail->type !== UpdatePost::TYPE_POLL) {
            return redirect()->route('pages.updates.list');
        }
        if (!$this->canAccessUpdate($dataDetail, Auth::id(), Auth::user()?->is_admin())) {
            return redirect()->route('pages.updates.list');
        }

        $validator = Validator::make($request->all(), [
            'option_id' => 'required|integer|exists:update_poll_options,id',
        ]);
        if ($validator->fails()) {
            return redirect()->route('pages.updates.detail', ['slug' => $slug])->withErrors($validator)->withInput();
        }

        $optionId = (int) $request->input('option_id');
        $option = $dataDetail->pollOptions->firstWhere('id', $optionId);
        if (!$option) {
            return redirect()->route('pages.updates.detail', ['slug' => $slug]);
        }

        DB::transaction(function () use ($dataDetail, $optionId) {
            $existingVote = UpdatePollVote::where('update_post_id', $dataDetail->id)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingVote) {
                if ((int) $existingVote->update_poll_option_id === $optionId) {
                    return;
                }
                UpdatePollOption::where('id', $existingVote->update_poll_option_id)->decrement('votes_count');
                $existingVote->update_poll_option_id = $optionId;
                $existingVote->save();
                UpdatePollOption::where('id', $optionId)->increment('votes_count');
                return;
            }

            UpdatePollVote::create([
                'update_post_id' => $dataDetail->id,
                'update_poll_option_id' => $optionId,
                'user_id' => Auth::id(),
            ]);
            UpdatePollOption::where('id', $optionId)->increment('votes_count');
        });

        return redirect()->route('pages.updates.detail', ['slug' => $slug])->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Vote submitted.',
        ]);
    }

    public function answer(Request $request, string $slug): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $dataDetail = UpdatePost::where('slug', $slug)->published()->first();
        if (!$dataDetail || $dataDetail->type !== UpdatePost::TYPE_QA) {
            return redirect()->route('pages.updates.list');
        }
        if (!$this->canAccessUpdate($dataDetail, Auth::id(), Auth::user()?->is_admin())) {
            return redirect()->route('pages.updates.list');
        }

        $validator = Validator::make($request->all(), [
            'answer' => 'required|string|min:2|max:3000',
        ]);
        if ($validator->fails()) {
            return redirect()->route('pages.updates.detail', ['slug' => $slug])->withErrors($validator)->withInput();
        }

        UpdateAnswer::create([
            'update_post_id' => $dataDetail->id,
            'user_id' => Auth::id(),
            'answer' => $request->input('answer'),
        ]);

        return redirect()->route('pages.updates.detail', ['slug' => $slug])->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Answer posted.',
        ]);
    }

    private function validateUpdate(Request $request, ?int $id = null)
    {
        return Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:10000',
            'city_id' => 'required|integer|exists:cities,id',
            'update_category_id' => 'required|integer|exists:update_categories,id',
            'type' => 'required|in:' . implode(',', array_keys($this->types())),
            'privacy' => 'required|in:' . UpdatePost::PRIVACY_PUBLIC . ',' . UpdatePost::PRIVACY_PRIVATE,
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
            'youtube_url' => 'nullable|url|max:500',
            'external_link' => 'nullable|url|max:500',
            'poll_question' => 'nullable|string|max:255',
            'poll_options' => 'nullable|array',
            'poll_options.*' => 'nullable|string|max:255',
            'qa_question' => 'nullable|string|max:255',
        ])->after(function ($validator) use ($request) {
            $type = $request->get('type');

            if ($type === UpdatePost::TYPE_IMAGE && !$request->hasFile('image') && empty($request->input('existing_image'))) {
                $validator->errors()->add('image', 'Image is required for image type updates.');
            }
            if ($type === UpdatePost::TYPE_YOUTUBE && empty($request->input('youtube_url'))) {
                $validator->errors()->add('youtube_url', 'YouTube URL is required for YouTube type updates.');
            }
            if ($type === UpdatePost::TYPE_POLL) {
                if (empty($request->input('poll_question'))) {
                    $validator->errors()->add('poll_question', 'Poll question is required for poll type updates.');
                }
                $options = collect($request->input('poll_options', []))
                    ->filter(fn ($v) => trim((string) $v) !== '')
                    ->values();
                if ($options->count() < 2) {
                    $validator->errors()->add('poll_options', 'At least 2 poll options are required.');
                }
            }
            if ($type === UpdatePost::TYPE_QA && empty($request->input('qa_question'))) {
                $validator->errors()->add('qa_question', 'Q&A question is required for Q&A type updates.');
            }
        });
    }

    private function fillUpdateFields(UpdatePost $update, array $validated, Request $request): void
    {
        $update->title = $validated['title'];
        $update->description = $validated['description'] ?? null;
        $update->city_id = (int) $validated['city_id'];
        $update->update_category_id = (int) $validated['update_category_id'];
        $update->type = $validated['type'];
        $update->privacy = $validated['privacy'];
        $update->external_link = $validated['external_link'] ?? null;
        $update->youtube_url = $validated['youtube_url'] ?? null;
        $update->poll_question = $validated['poll_question'] ?? null;
        $update->qa_question = $validated['qa_question'] ?? null;

        if ($request->file('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '-' . rand(1000, 9999) . '.' . $ext;
            $destination = public_path('images/updates');
            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $fileName);
            $update->image = $fileName;
        }
    }

    private function syncTypeSpecificData(UpdatePost $update, array $validated, bool $isEdit = false): void
    {
        if ($update->type === UpdatePost::TYPE_POLL) {
            if ($isEdit) {
                $update->pollOptions()->delete();
            }
            $options = collect($validated['poll_options'] ?? [])
                ->filter(fn ($v) => trim((string) $v) !== '')
                ->values();

            foreach ($options as $index => $optionText) {
                $update->pollOptions()->create([
                    'option_text' => trim((string) $optionText),
                    'sort_order' => $index + 1,
                    'votes_count' => 0,
                ]);
            }
            return;
        }

        if ($isEdit) {
            if ($update->type !== UpdatePost::TYPE_QA) {
                $update->answers()->delete();
            }
            if ($update->type !== UpdatePost::TYPE_POLL) {
                $update->pollOptions()->delete();
            }
        }
    }

    private function canAccessUpdate(UpdatePost $update, ?int $viewerId, bool $isAdmin = false): bool
    {
        if ($update->privacy === UpdatePost::PRIVACY_PUBLIC) {
            return true;
        }
        if (!$viewerId) {
            return false;
        }
        if ($isAdmin) {
            return true;
        }
        return (int) $update->created_by === (int) $viewerId;
    }

    private function types(): array
    {
        return [
            UpdatePost::TYPE_STATUS => 'Status',
            UpdatePost::TYPE_IMAGE => 'Image',
            UpdatePost::TYPE_YOUTUBE => 'YouTube',
            UpdatePost::TYPE_POLL => 'Poll',
            UpdatePost::TYPE_QA => 'Q&A',
        ];
    }
}

