<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\CommonHelper;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Location", "route" => ""],
            ],
            "title" => "Location List"
        ];
        $dataList = Location::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.location.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Location::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Location", "route" => "dashboard.location"],
                    ["title" => "Detail", "route" => ""]
                ],
                "title" => "Location Detail"
            ];
            return view('dashboard.location.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
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
                ["title" => "Location", "route" => "dashboard.location"],
                ["title" => "Create", "route" => ""]
            ],
            "title" => "Create Location"
        ];
        $locationData = Location::where('parent_id', 2)->orderBy('name')->get();
        return view('dashboard.location.create', ['metaData' => $metaData, 'locationData' => $locationData]);
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = Location::find($id);
        if ($dataDetail) {
            return view('dashboard.location.edit', ['dataDetail' => $dataDetail, 'metaData' => []]);
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
        $dataDetail = Location::find($id);
        if ($dataDetail || $id == 0) {
            if ($id == 0) {
                $dataDetail = new Location();
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'name_gj' => 'required|max:255',
                'slug' => ['required', 'unique:locations,slug,' . $id, 'min:5', 'max:255', 'regex:/^[a-z][a-z0-9]*(-[a-z0-9]+)*$/i'],
                'meta_description' => 'required',
                'meta_keywords' => 'required',
                'description' => 'required',
                'description_gj' => 'required',
                'latitude' => 'required',
                'longitude' => 'required'
            ]);

            if ($validator->fails()) {
                if($id > 0) {
                    return redirect('dashboard/location/edit/' . $id)->withErrors($validator)->withInput();
                } else {
                    return redirect('dashboard/location/create')->withErrors($validator)->withInput();
                }
            }

            $dataToInsert = $validator->validated();

            if ($request->croppedImage != null) {
                $croped_image = $request->croppedImage;
                list($type, $croped_image) = explode(';', $croped_image);
                list(, $croped_image)      = explode(',', $croped_image);
                $croped_image = base64_decode($croped_image);
                $image_name = $dataToInsert['slug'].".png"; //time() . rand(10000000, 999999999) . '.png';
                file_put_contents("./images/location/" . $image_name, $croped_image);
                $dataDetail->image = $image_name;
            }

            $dataDetail->name = $dataToInsert['name'];
            $dataDetail->name_gj = $dataToInsert['name_gj'];
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->description_gj = $dataToInsert['description_gj'];
            $dataDetail->slug = $dataToInsert['slug'];
            $dataDetail->meta_description = $dataToInsert['meta_description'];
            $dataDetail->meta_keywords = $dataToInsert['meta_keywords'];
            $dataDetail->latitude = $dataToInsert['latitude'];
            $dataDetail->longitude = $dataToInsert['longitude'];
            $dataDetail->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.location')->with($message);
        } else {
            return redirect()->route('dashboard.location');
        }
    }

    public function delete(Request $request, $id)
    {        
        $dataDetail = Location::find($id);
        if ($dataDetail) {
            $dataDetail->delete();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_deleted')
                ]
            ];
            return redirect()->route('dashboard.location')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.location')->with($message);
        }
    }
}
