<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\BlogCategories;
use App\Models\News;
use App\Models\NewsCategory;
use URL;

class NewsController extends Controller
{
    public function index(Request $request) //: View
    {

        $dataList = NewsCategory::where('parent_id', null)->orderBy('name', 'ASC')->get();
        $dataList = $dataList->split(3);

        $metaData = [
            "title" => "Latest Gujarat & India News | GujjuTicks News",
            "description" => "Catch the latest news, top stories, and real-time updates from Gujarat and across India. Stay informed with GujjuTicks – your source for reliable Gujarati and Indian news.",
            //"image" => "",
            "keywords" => "Gujarat news, India news, Gujarati news updates, breaking news Gujarat, Indian headlines, current affairs India, GujjuTicks news, latest Gujarat news, trending India news, local Gujarati news",
            "url" => route('pages.news.list')
        ];

        return view('pages.news.list', ['metaData' => $metaData,  'dataList' => $dataList]);
    }

    public function view(Request $request, $slug)
    {
        $dataDetail = NewsCategory::where("slug", $slug)->first();
        if ($dataDetail) {

            // to set meta data of page
            $metaData = [
                "title" => $dataDetail->name . " - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                "image" => "", //URL::asset('/images/cities/' . $dataDetail->image),
                "url" => route('pages.news.detail', ['slug' => $dataDetail->slug])
            ];
            $dataList = NewsCategory::where('parent_id', $dataDetail->id)->get();

            $dataListNews = News::where('is_featured', 0);
            if($dataDetail->parent_id > 0){
                $dataListNews = $dataListNews->where('news_category_id', $dataDetail->id);
            } else {
                $ids = $dataList->pluck('id')->toArray();
                $dataListNews = $dataListNews->whereIn('news_category_id', $ids);
            }
            $dataListNews = $dataListNews->paginate(9)->withQueryString();
            return view('pages.news.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData, 'dataList' => $dataList, 'dataListNews' => $dataListNews]);
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
