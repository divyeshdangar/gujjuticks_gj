<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Helpers\ImageHelper;

class PublicImageController extends Controller
{
    public function view(Request $request, $slug)
    {
        $dataDetail = Image::select('id', 'image', 'type', 'height', 'width', 'bg_color', 'colors', 'generator')->where("slug", $slug)->first();
        if ($dataDetail) {
            $background = array(
                "type" => $dataDetail->type,
                "height" => $dataDetail->height,
                "width" => $dataDetail->width,
                "image" => config('paths.images.dynamic') . $dataDetail->image,
                "color" => $dataDetail->bg_color,
                "colors" => explode(",", $dataDetail->colors)
            );
            if (empty($background["colors"]) || empty($background["colors"][0])) {
                $background["colors"][0] = "#000000";
            }

            $img = new ImageHelper();
            $img->setBackground($background);
            if (!empty($dataDetail->data)) {
                $img->setExtraData($dataDetail->data);
            }

            $img->showImage();
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
}
