<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Helpers\ImageHelper;
use App\Models\News;

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
                        if ($value->random_identity == "dynamic-text") {
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
        return $this->goBack();
    }

    public function news(Request $request, $slug)
    {
        if (str_ends_with(strtolower($slug), '.jpg')) {

            $slug = preg_replace('/\.jpg$/i', '', $slug);
            $dataDetail = News::where("slug", $slug)->first();
            dd($dataDetail);

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
                        if ($value->random_identity == "dynamic-text") {
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
        return $this->goBack();
    }

    public function category(Request $request, $slug)
    {
        if (str_ends_with(strtolower($slug), '.jpg')) {


            $slug = preg_replace('/\.jpg$/i', '', $slug);

            $parts = explode('-in-', $slug);
            $category = $parts[0] ?? '';
            $category_slug = str_replace('-', '_', $category);
            $location = $parts[1] ?? '';

            if (!empty($category) && !empty($location)) {
                $category = ucwords(str_replace('-', ' ', $category));
                $location = ucwords(str_replace('-', ' ', $location));
            } else {
                return $this->goBack();
            }

            $dataDetail = Image::select('id', 'image', 'type', 'height', 'width', 'bg_color', 'colors', 'generator')->where("slug", "business-in-city")->first();
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
                        if ($value->is_editable == "1") {
                            if ($value->random_identity == "category") {
                                $value->text = $category;
                            }
                            if ($value->random_identity === "city-name") {
                                $value->text = $location;
                            }
                            if ($value->random_identity === "icon-image") {
                                $value->add_image = config('paths.images.cities_category') . $category_slug.'.png';
                            }
                        }
                    }
                    $img->setExtraData($dataDetail->data);
                }
                $img->showImage();
                return;
            }
        }
        return $this->goBack();
    }

    public function goBack()
    {
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
