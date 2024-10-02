<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Uploads;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{

    public function index(Request $request)
    {
        $dataList = Image::orderBy('id', 'DESC');
        if(!Auth::user()->is_admin()){
            $dataList->where('user_id', Auth::id());
        }
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.image.index', ['dataList' => $dataList, 'metaData' => []]);
    }

    public function create(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Image", "route" => "dashboard.image"],
                ["title" => "Create", "route" => ""]
            ],
            "title" => "Create Image"
        ];
        return view('dashboard.image.create', ['metaData' => $metaData]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if($dataDetail) {
            $dataUploads = Uploads::where("image_id", $id)->get();
            return view('dashboard.image.view', ['dataDetail' => $dataDetail, 'metaData' => [], 'dataUploads' => $dataUploads]);
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

    public function edit(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Image", "route" => "dashboard.image"],
                    ["title" => "Edit", "route" => ""],
                ],
                "title" => $dataDetail->title
            ];
            return view('dashboard.image.edit', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
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
        $dataDetail = Image::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new Image();
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slug' => ['required', 'unique:images,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'description' => 'required',
                'height' => 'required|numeric|min:100|max:5000',
                'width' => 'required|numeric|min:100|max:5000',
                'options' => 'required',
            ]);

            if ($validator->fails()) {
                if($id > 0) {
                    return redirect('dashboard/image/edit/' . $id)->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/image/create')->withErrors($validator)->withInput();
                }
            }

            $dataToInsert = $validator->validated();

            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->slug = $dataToInsert['slug'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];
            $dataDetail->height = $dataToInsert['height'];
            $dataDetail->width = $dataToInsert['width'];
            $dataDetail->options = $dataToInsert['options'];
            if($id == 0) {
                $dataDetail->user_id = Auth::id();
            }
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        } else {
            return redirect()->route('dashboard.image');
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {
            $validator = Validator::make($request->all(), [
                'options' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('dashboard/image/view/' . $id)->withErrors($validator)->withInput();
            }
            $dataToInsert = $validator->validated();
            $dataDetail->options = $dataToInsert['options'];
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.image.view', ['id' => $id])->with($message);
        } else {
            return redirect()->route('dashboard.image');
        }
    }

    public function delete(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {
            $dataDetail->delete();
            return redirect()->route('dashboard.image');
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        }
    }

    public function copy(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {            
            $newPost = $dataDetail->replicate();
            $newPost->created_at = Carbon::now();
            $newPost->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.image')->with($message);
        }
    }

    public function upload(Request $request, $id): RedirectResponse
    {
        $dataDetail = Image::find($id);
        if ($dataDetail) {
            $validator = Validator::make($request->all(), [
                'image' => 'sometimes|file|mimes:jpg,jpeg,png|max:4048',
            ]);

            if ($validator->fails()) {
                return redirect('dashboard/image/view/'.$id)->withErrors($validator)->withInput();
            }
            if ($request->file('image')) {
                $dataDetail = new Uploads();
                $dataDetail->user_id = Auth::id();
                $dataDetail->image_id = $id;
                $dataDetail->original_name = $request->file('image')->getClientOriginalName(); 
                $temp = explode(".", $dataDetail->original_name);
                $fileName = time().'-'.rand(0, time()).'.'. end($temp);
                $request->image->storeAs('images/dynamic', $fileName, 'public');
                $dataDetail->image = $fileName;
                $dataDetail->save();
            }

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.image.view', ["id" => $id])->with($message);
        } else {
            return redirect()->route('dashboard.image');
        }
    }

}