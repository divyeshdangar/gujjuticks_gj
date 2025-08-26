<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\City;
use App\Models\PlaceCategory;
use URL;
use App\Services\OpenAIService;

class CitiesController extends Controller
{

    public function index(Request $request): View
    {
        // to set meta data of page
        $metaData = [
            "title" => "GujjuTicks City Directory - Gujarat’s Top Cities",
            "description" => "Browse Gujarat’s top cities on GujjuTicks. From Ahmedabad to Bhavnagar, discover businesses, attractions, news and resources for every city in the state.",
            "keywords" => "GujjuTicks city directory, Gujarat city list, Gujarat travel guide, Ahmedabad, Surat, Rajkot, Vadodara, Bhavnagar",
            //"image" => "",
            "url" => route('pages.cities.list')
        ];

        $dataList = City::orderBy('slug', 'ASC')->paginate(9)->withQueryString();
        $categories = PlaceCategory::where('is_active', '1')->limit(9)->get();

        return view('pages.cities.list', ['metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories]);
    }

    public function view(Request $request, $slug)
    {
        $dataDetail = City::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => $dataDetail->title . " - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                "image" => URL::asset('/images/cities/' . $dataDetail->image),
                "url" => route('pages.cities.detail', ['slug' => $dataDetail->slug])
            ];
            $categories = PlaceCategory::where('is_active', '1')->orderBy('name', 'ASC')->get();
            //$categories = $categories->split(3); // split the Collection into 3 roughly-equal chunks

            $dataList = City::where('id', '<>', $dataDetail->id)->limit(3)->get();

            return view('pages.cities.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories]);
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

    public function category_businesses_list(Request $request, $slug, $category)
    {

        $dataDetail = City::where("slug", $slug)->first();
        if ($dataDetail) {
            $businessCategory = PlaceCategory::where("name", str_replace('-', '_', $category))->first();
            if ($businessCategory) {
                // to set meta data of page
                $metaData = [
                    "title" => $businessCategory->label . " in " . $dataDetail->name . " - GujjuTicks",
                    "no_title" => true,
                    "description" => $businessCategory->getMetaDescription($dataDetail->name),
                    "image" =>  route('pages.image.category', ['slug' => str_replace('_', '-', $businessCategory->name) . '-in-' . $dataDetail->slug . '.jpg']),  //URL::asset('/images/cities/' . $dataDetail->image),
                    "url" => route('pages.cities.businesses.list', ['slug' => $dataDetail->slug, 'category' => str_replace('_', '-', $businessCategory->name)])
                ];
                $dataList = Business::where('city_id', $dataDetail->id)->where('place_category_id', $businessCategory->id)->paginate(10)->withQueryString();

                $citiesList = City::where('id', '<>', $dataDetail->id)->limit(3)->get();

                return view('pages.cities.category_businesses_list', ['dataList' => $dataList, 'dataDetail' => $dataDetail, 'metaData' => $metaData, 'dataDetail' => $dataDetail, 'businessCategory' => $businessCategory, 'citiesList' => $citiesList]);
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
