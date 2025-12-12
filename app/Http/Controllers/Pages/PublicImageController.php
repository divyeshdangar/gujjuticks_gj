<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Helpers\ImageHelper;
use App\Models\ImageDataGenerated;
use App\Models\ImagesData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
                $slugId = $request->query('id');
                if ($slugId && strlen($slugId) == 12) {
                    $imageData = ImageDataGenerated::select('options')->where('image_id', $dataDetail->id)->where('slugId', $slugId)->first();
                    $imageData = ($dataDetail) ? $imageData->options : [];
                    $img->setExtraData($dataDetail->data, $imageData);
                } else {
                    $img->setExtraData($dataDetail->data);
                }
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

    public function try(Request $request, $slug)
    {
        $dataDetail = Image::where("slug", $slug)->first();
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

            $slugId = $request->query('id');
            $imageData = [];
            if ($slugId && strlen($slugId) == 12) {
                $imageData = ImageDataGenerated::select('options')->where('image_id', $dataDetail->id)->where('slug', $slugId)->first();
                $imageData = ($dataDetail) ? $imageData->options : [];
            }

            // $img = new ImageHelper();
            // $img->setBackground($background);
            // if (!empty($dataDetail->data)) {
            //     $img->setExtraData($dataDetail->data);
            // }

            return view('pages.image.view', ['metaData' => [], 'dataDetail' => $dataDetail, 'imageData' => $imageData]);
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

    public function store(Request $request, $slug)
    {
        // $validator = Validator::make($request->all(), [
        //     'data' => 'required|string',
        // ]);

        // if ($validator->fails()) {
        //     return back()->withErrors($validator)->withInput();
        // }
        $dataDetail = Image::where("slug", $slug)->first();
        if ($dataDetail) {
            $data = $request->except(['_token']);

            $insertData = new ImageDataGenerated();
            do {
                $idSlug = Str::random(12);
            } while (ImageDataGenerated::where('slug', $idSlug)->exists());
            $insertData->slug = $idSlug;

            $insertData->image_id = $dataDetail->id;
            $insertData->user_id = Auth::check() ? Auth::user()->id : null;
            $insertData->options = $data;
            $insertData->save();

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('pages.image.editor.detail', ['slug' => $slug, 'id' => $insertData->slug])->with($message);
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
