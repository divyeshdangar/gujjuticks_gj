<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use URL;

class PublicImageController extends Controller
{
    public function view(Request $request, $slug)
    {
        $dataDetail = Image::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => $dataDetail->title." - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                "image" => URL::asset('/images/dynamic/'.$dataDetail->image),
                "url" => route('pages.image.detail', ['slug' => $dataDetail->slug]),
            ];
            return view('pages.image.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('home')->with($message);
        }
    }

    public function store(Request $request)
    {
        if ($request->data != null) {
            $croped_image = $request->data;
            list($type, $croped_image) = explode(';', $croped_image);
            list(, $croped_image)      = explode(',', $croped_image);
            $croped_image = base64_decode($croped_image);
            $image_name = time() . rand(10000000, 999999999) . '.png';
            file_put_contents("./images/dynamic/" . $image_name, $croped_image);
        }
    }


}
