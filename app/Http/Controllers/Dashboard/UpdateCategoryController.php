<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UpdateCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateCategoryController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            'breadCrumb' => [
                ['title' => 'Update Category', 'route' => ''],
            ],
            'title' => 'Update Categories List',
        ];

        $dataList = UpdateCategory::orderBy('sort_order')->orderBy('id', 'DESC');
        if ($request->filled('search')) {
            $dataList->where('name', 'LIKE', '%' . $request->get('search') . '%');
        }
        $dataList = $dataList->paginate(20)->withQueryString();

        return view('dashboard.update-category.index', [
            'metaData' => $metaData,
            'dataList' => $dataList,
        ]);
    }

    public function create(Request $request)
    {
        $metaData = [
            'breadCrumb' => [
                ['title' => 'Update Category', 'route' => 'dashboard.update.category'],
                ['title' => 'Create', 'route' => ''],
            ],
            'title' => 'Create Update Category',
        ];

        return view('dashboard.update-category.create', ['metaData' => $metaData]);
    }

    public function edit(Request $request, int $id)
    {
        $dataDetail = UpdateCategory::find($id);
        if (!$dataDetail) {
            return redirect()->route('dashboard.update.category')->with('message', [
                'type' => 'error',
                'title' => __('dashboard.bad'),
                'description' => __('dashboard.no_record_found'),
            ]);
        }

        $metaData = [
            'breadCrumb' => [
                ['title' => 'Update Category', 'route' => 'dashboard.update.category'],
                ['title' => 'Edit', 'route' => ''],
            ],
            'title' => $dataDetail->name,
        ];

        return view('dashboard.update-category.edit', [
            'metaData' => $metaData,
            'dataDetail' => $dataDetail,
        ]);
    }

    public function store(Request $request, int $id): RedirectResponse
    {
        $dataDetail = $id > 0 ? UpdateCategory::find($id) : new UpdateCategory();
        if (!$dataDetail) {
            return redirect()->route('dashboard.update.category');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'min:3', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i', 'unique:update_categories,slug,' . $id],
            'description' => 'nullable|string|max:2000',
            'sort_order' => 'nullable|integer|min:0|max:65535',
            'is_active' => 'nullable|in:0,1',
            'is_important' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            if ($id > 0) {
                return redirect('dashboard/update-category/edit/' . $id)->withErrors($validator)->withInput();
            }
            return redirect('dashboard/update-category/create')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $dataDetail->name = $validated['name'];
        $dataDetail->slug = $validated['slug'];
        $dataDetail->description = $validated['description'] ?? null;
        $dataDetail->sort_order = $validated['sort_order'] ?? 0;
        $dataDetail->is_active = (bool) ($validated['is_active'] ?? '1');
        $dataDetail->is_important = (bool) ($validated['is_important'] ?? '0');
        $dataDetail->save();

        return redirect()->route('dashboard.update.category')->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => __('dashboard.details_submitted'),
        ]);
    }

    public function delete(Request $request, int $id)
    {
        $dataDetail = UpdateCategory::find($id);
        if (!$dataDetail) {
            return redirect()->route('dashboard.update.category')->with('message', [
                'type' => 'error',
                'title' => __('dashboard.bad'),
                'description' => __('dashboard.no_record_found'),
            ]);
        }

        $dataDetail->is_active = false;
        $dataDetail->save();

        return redirect()->route('dashboard.update.category')->with('message', [
            'type' => 'success',
            'title' => __('dashboard.great'),
            'description' => 'Category disabled successfully.',
        ]);
    }
}

