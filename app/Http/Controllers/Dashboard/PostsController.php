<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Days;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Posts", "route" => ""],
            ],
            "title" => "Posts List"
        ];

        $dataList = Days::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.posts.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Days::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Posts", "route" => "dashboard.posts"],
                    ["title" => "Detail", "route" => ""]
                ],
                "title" => "Posts Detail"
            ];
            return view('dashboard.posts.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData, 'postTypes' => Days::Types]);
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

    public function create(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Posts", "route" => "dashboard.posts"],
                ["title" => "Create", "route" => ""]
            ],
            "title" => "Create Posts"
        ];
        return view('dashboard.posts.create', ['metaData' => $metaData, 'postTypes' => Days::Types]);
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = Days::find($id);
       if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Posts", "route" => "dashboard.posts"],
                    ["title" => "Edit", "route" => ""]
                ],
                "title" => "Posts Edit"
            ];
            return view('dashboard.posts.edit', ['dataDetail' => $dataDetail, 'metaData' => $metaData, 'postTypes' => Days::Types]);
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
        $dataDetail = Days::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new Days();
            }
            $validator = Validator::make($request->all(), [
                'slug' => ['required', 'unique:days,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'type' => 'required',
                
                'title' => 'required|max:255',
                'day' => 'sometimes',
                'month' => 'sometimes',
                'year' => 'sometimes',
                'description' => 'sometimes',

                'title_g' => 'sometimes',
                'day_g' => 'sometimes',
                'month_g' => 'sometimes',
                'year_g' => 'sometimes',
                'description_g' => 'sometimes',

                'title_h' => 'sometimes',
                'day_h' => 'sometimes',
                'month_h' => 'sometimes',
                'year_h' => 'sometimes',
                'description_h' => 'sometimes',

                'extra' => 'sometimes',
                'image' => 'sometimes|file|mimes:jpg,jpeg,png|max:4048',
                'image_g' => 'sometimes|file|mimes:jpg,jpeg,png|max:4048',
                'image_h' => 'sometimes|file|mimes:jpg,jpeg,png|max:4048',
            ]);

            if ($validator->fails()) {
                if($id > 0) {
                    return redirect('dashboard/posts/edit/' . $id)->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/posts/create')->withErrors($validator)->withInput();
                }
            }
            $dataToInsert = $validator->validated();

            $dataDetail->slug = $dataToInsert['slug'];
            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->type = $dataToInsert['type'];
            $dataDetail->day = $dataToInsert['day'];
            $dataDetail->month = $dataToInsert['month'];
            $dataDetail->year = ($dataToInsert['year']) ? $dataToInsert['year'] : "";
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->title_g = $dataToInsert['title_g'];
            $dataDetail->day_g = $dataToInsert['day_g'];
            $dataDetail->month_g = $dataToInsert['month_g'];
            $dataDetail->year_g = $dataToInsert['year_g'];
            $dataDetail->description_g = $dataToInsert['description_g'];
            $dataDetail->title_h = $dataToInsert['title_h'];
            $dataDetail->day_h = $dataToInsert['day_h'];
            $dataDetail->month_h = $dataToInsert['month_h'];
            $dataDetail->year_h = $dataToInsert['year_h'];
            $dataDetail->description_h = $dataToInsert['description_h'];
            $dataDetail->extra = $dataToInsert['extra'];

            if ($request->file('image')) {
                $fileName = time().'-'.rand(0, time()).'.jpg';
                $request->image->storeAs('images/posts', $fileName, 'public');
                $dataDetail->image = $fileName;
            }
            if ($request->file('image_g')) {
                $fileName = time().'-'.rand(0, time()).'.jpg';
                $request->image_g->storeAs('images/posts', $fileName, 'public');
                $dataDetail->image_g = $fileName;
            }
            if ($request->file('image_h')) {
                $fileName = time().'-'.rand(0, time()).'.jpg';
                $request->image_h->storeAs('images/posts', $fileName, 'public');
                $dataDetail->image_h = $fileName;
            }

            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.posts')->with($message);
        } else {
            return redirect()->route('dashboard.posts');
        }
    }

    public function delete(Request $request, $id)
    {        
        $dataDetail = Days::find($id);
       if ($dataDetail) {
            $dataDetail->delete();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_deleted')
                ]
            ];
            return redirect()->route('dashboard.posts')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.posts')->with($message);
        }
    }
}
