<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CardCategory;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class CardsController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Cards", "route" => ""],
            ],
            "title" => "Cards List"
        ];
        $dataList = Card::withTrashed()->orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.card.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function create(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Cards", "route" => "dashboard.card"],
                ["title" => "Edit", "route" => ""],
            ],
            "title" => "Create"
        ];
        $dataDetail = new Card();
        $categoryData = CardCategory::orderBy('name')->get();
        return view('dashboard.card.create', ['categoryData' => $categoryData, 'dataDetail' => $dataDetail, 'metaData' => $metaData]);
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = Card::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Cards", "route" => "dashboard.card"],
                    ["title" => "Edit", "route" => ""],
                ],
                "title" => $dataDetail->title
            ];
            $categoryData = CardCategory::orderBy('name')->get();
            return view('dashboard.card.edit', ['categoryData' => $categoryData, 'dataDetail' => $dataDetail, 'metaData' => $metaData]);
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
        $dataDetail = Card::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new Card();
            }

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slug' => ['required', 'unique:cards,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'description' => 'required',
                'keywords' => 'sometimes',
                'price' => 'required|numeric|regex:/^\d{1,6}(\.\d{1,2})?$/',
                'is_featured' => 'sometimes',
                'card_category_id' => 'required',
            ]);

            if ($validator->fails()) {
                if ($id == 0) {
                    return redirect('dashboard/card/create')->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/card/edit/' . $id)->withErrors($validator)->withInput();
                }
            }

            $dataToInsert = $validator->validated();
            $dataDetail->slug = $dataToInsert['slug'];

            if ($request->file('front_image')) {
                $file = $request->file('front_image');
                $extension = $file->getClientOriginalExtension();
                $fileName = $dataToInsert['slug'] . time() . '-front.' . $extension;
                $file->move(public_path(config('paths.images.card')), $fileName);
                $dataDetail->front_image = $fileName;
            } elseif(empty($dataDetail->front_image)) {
                $dataDetail->front_image = 'default.png';
            }
            if ($request->file('back_image')) {
                $file = $request->file('back_image');
                $extension = $file->getClientOriginalExtension();
                $fileName = $dataToInsert['slug'] . time() . '-back.' . $extension;
                $file->move(public_path(config('paths.images.card')), $fileName);
                $dataDetail->back_image = $fileName;
            } elseif(empty($dataDetail->back_image)) {
                $dataDetail->back_image = 'default.png';
            }

            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];
            $dataDetail->card_category_id = $dataToInsert['card_category_id'];            
            $dataDetail->keywords = $dataToInsert['keywords'];
            $dataDetail->is_featured = $dataToInsert['is_featured'];
            $dataDetail->price = $dataToInsert['price'];
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.card')->with($message);
        } else {
            return redirect()->route('dashboard.card');
        }
    }

    public function delete(Request $request, $id)
    {
        $dataDetail = Card::find($id);
        if ($dataDetail) {
            $dataDetail->delete();
            return redirect()->route('dashboard.card');
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.card')->with($message);
        }
    }

    public function restore(Request $request, $id)
    {
        $dataDetail = Card::withTrashed()->find($id);
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
            return redirect()->route('dashboard.card')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.card')->with($message);
        }
    }
}
