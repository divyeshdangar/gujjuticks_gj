<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CardCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class CardsCategoryController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Card Category", "route" => ""],
            ],
            "title" => "Card Categories List"
        ];
        $dataList = CardCategory::withTrashed()->orderBy('id', 'DESC')->withCount('cards');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.card-category.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function create(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Card Category", "route" => "dashboard.card.category"],
                ["title" => "Edit", "route" => ""],
            ],
            "title" => "Create"
        ];
        $dataDetail = new CardCategory();
        return view('dashboard.card-category.create', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = CardCategory::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Card Category", "route" => "dashboard.card.category"],
                    ["title" => "Edit", "route" => ""],
                ],
                "title" => $dataDetail->name
            ];
            return view('dashboard.card-category.edit', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard')->with($message);
        }
    }

    public function store(Request $request, $id): RedirectResponse
    {
        $dataDetail = CardCategory::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new CardCategory();
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'slug' => ['required', 'unique:cards,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'description' => 'required',
                'keywords' => 'sometimes',
                'is_featured' => 'sometimes',
            ]);

            if ($validator->fails()) {
                if ($id == 0) {
                    return redirect('dashboard/card-category/create')->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/card-category/edit/' . $id)->withErrors($validator)->withInput();
                }
            }

            $dataToInsert = $validator->validated();
            if ($request->file('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = $dataToInsert['slug'] . '-' . time() . '.' . $extension;
                $file->move(public_path('images/card-category'), $fileName);
                $dataDetail->image = $fileName;
            }

            $dataDetail->name = $dataToInsert['name'];
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];
            $dataDetail->keywords = $dataToInsert['keywords'];
            $dataDetail->is_featured = $dataToInsert['is_featured'];
            $dataDetail->slug = $dataToInsert['slug'];
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.card.category')->with($message);
        } else {
            return redirect()->route('dashboard.card.category');
        }
    }

    public function delete(Request $request, $id)
    {
        $dataDetail = CardCategory::find($id);
        if ($dataDetail) {
            $dataDetail->delete();
            return redirect()->route('dashboard.card.category');
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.card.category')->with($message);
        }
    }

    public function restore(Request $request, $id)
    {
        $dataDetail = CardCategory::withTrashed()->find($id);
        if ($dataDetail) {
            $dataDetail->deleted_at = Null;
            $dataDetail->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_restored')
                ]
            ];
            return redirect()->route('dashboard.card.category')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.card.category')->with($message);
        }
    }
}
