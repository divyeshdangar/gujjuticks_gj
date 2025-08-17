<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Pages", "route" => ""],
            ],
            "title" => "Pages List"
        ];
        $dataList = Pages::orderBy('id', 'DESC')->where('status', '1');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.pages.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Pages::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Pages", "route" => "dashboard.pages"],
                    ["title" => "Detail", "route" => ""]
                ],
                "title" => "Pages Detail"
            ];
            return view('dashboard.pages.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
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
                ["title" => "Pages", "route" => "dashboard.pages"],
                ["title" => "Create", "route" => ""]
            ],
            "title" => "Create Pages"
        ];
        return view('dashboard.pages.create', ['metaData' => $metaData]);
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = Pages::find($id);
        if ($dataDetail) {
            return view('dashboard.pages.edit', ['dataDetail' => $dataDetail, 'metaData' => []]);
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
        $dataDetail = Pages::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new Pages();
                $dataDetail->user_id = Auth::id();
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'slug' => ['required', 'unique:pages,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                if($id > 0) {
                    return redirect('dashboard/pages/edit/' . $id)->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/pages/create')->withErrors($validator)->withInput();
                }
            }

            $dataToInsert = $validator->validated();

            if ($request->croppedImage != null) {
                $croped_image = $request->croppedImage;
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image)      = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $image_name = $dataToInsert['slug'].".png"; //time() . rand(10000000, 999999999) . '.png';
                file_put_contents("./images/pages/" . $image_name, $croped_image);
                $dataDetail->image = $image_name;
            }

            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->slug = $dataToInsert['slug'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.pages')->with($message);
        } else {
            return redirect()->route('dashboard.pages');
        }
    }

    public function delete(Request $request, $id)
    {        
        $dataDetail = Pages::find($id);
        if ($dataDetail) {
            $dataDetail->status = '0';
            $dataDetail->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_deleted')
                ]
            ];
            return redirect()->route('dashboard.pages')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.pages')->with($message);
        }
    }

}
