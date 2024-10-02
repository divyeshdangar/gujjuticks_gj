<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Location;
use URL;

class GujaratController extends Controller
{
    public function index(Request $request): View
    {
        // to set meta data of page
        $metaData = [
            "title" => "Discover the Essence of Gujarat: Insights and Stories from GujjuTicks Blogs",
            "description" => "Explore insightful blogs on Gujju culture, traditions, cuisine, and more. Discover fascinating stories and tips that celebrate the vibrant spirit of Gujarat, brought to you by GujjuTicks.",
            //"image" => "",
            "url" => route('pages.gujarat')
        ];
        $dataList = Location::where('parent_id', '2')->orderBy('name', 'ASC')->get();
        return view('pages.gujarat.index', ['metaData' => $metaData, 'dataList' => $dataList]);
    }

    public function district(Request $request, $slug)
    {
        $dataDetail = Location::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => $dataDetail->name." - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                "image" => URL::asset('/images/location/'.$dataDetail->image),
                "url" => route('pages.gujarat.district', ['slug' => $dataDetail->slug]),
            ];
            return view('pages.gujarat.district', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('gujarat')->with($message);
        }
    }
}
