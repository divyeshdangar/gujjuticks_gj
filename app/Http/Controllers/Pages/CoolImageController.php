<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Helpers\ImageHelper;

class CoolImageController extends Controller
{
    public function view(Request $request, $slug)
    {

        $data = explode("-", $slug);
        if (is_array($data) && (count($data) == 2) && str_ends_with(strtolower($data[1]), '.jpg')) {
            $dataDetail = Image::select('id', 'image', 'type', 'height', 'width', 'bg_color', 'colors', 'generator')->where("slug", $data[0])->first();
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

					foreach ($dataDetail->data as $key => $value) {
						if($value->random_identity=="dynamic-text"){
							$value->text = strtoupper(substr($data[1], 0, -4));
                            break;
						}
					}
                    $img->setExtraData($dataDetail->data);
				}
                $img->showImage();
                return;
            }
        }
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
