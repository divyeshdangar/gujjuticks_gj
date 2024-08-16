<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Blog;
use App\Models\BlogCategories;

class BlogController extends Controller
{
    public $languages = [
        'e' => 'English',
        'h' => 'हिन्दी',
        'g' => 'ગુજરાતી'
    ];
    public function index(Request $request): View
    {
        // to set meta data of page
        $metaData = [
            "title" => "Discover the Essence of Gujarat: Insights and Stories from GujjuTicks Blogs",
            "description" => "Explore insightful blogs on Gujju culture, traditions, cuisine, and more. Discover fascinating stories and tips that celebrate the vibrant spirit of Gujarat, brought to you by GujjuTicks.",
            //"image" => "",
            "url" => route('pages.blog.list')
        ];
        $dataList = Blog::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(5)->withQueryString();
        $categories = BlogCategories::where("status", "1")->limit(6)->get();

        return view('pages.blog.list', ['metaData' => $metaData, 'lang' => $this->languages, 'dataList' => $dataList, 'categories' => $categories]);
    }

    public function view(Request $request, $slug)
    {
        $dataDetail = Blog::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => $dataDetail->title." - GujjuTicks",
                "no_title" => true,
                "description" => "",
                //"image" => "",
                "url" => route('pages.blog.detail', ['slug' => $dataDetail->slug]),
                // "breadCrumb" => [
                //     ["title" => "Board", "route" => "dashboard.board"],
                //     ["title" => "Create", "route" => ""]
                // ]
            ];
            $categories = BlogCategories::where("status", "1")->where('id', '<>', $dataDetail->id)->limit(3)->get();
            $dataList = Blog::where("status", "1")->where('id', '<>', $dataDetail->id)->limit(3)->get();
            return view('pages.blog.view', ['dataDetail' => $dataDetail, 'lang' => $this->languages, 'metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories]);
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

    public function category(Request $request, $slug)
    {
        $dataDetail = BlogCategories::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => $dataDetail->title." - GujjuTicks",
                "no_title" => true,
                "description" => $dataDetail->meta_description,
                //"image" => "",
                "url" => route('pages.blog.category.detail', ['slug' => $dataDetail->slug]),
                // "breadCrumb" => [
                //     ["title" => "Board", "route" => "dashboard.board"],
                //     ["title" => "Create", "route" => ""]
                // ]
            ];
            $categories = BlogCategories::where("status", "1")->where('id', '<>', $dataDetail->id)->limit(3)->get();
            $dataList = Blog::where("status", "1")
                //->where('id', '<>', $dataDetail->id)
                ->limit(3)->get();
            return view('pages.blog.category', ['dataDetail' => $dataDetail, 'lang' => $this->languages, 'metaData' => $metaData, 'dataList' => $dataList, 'categories' => $categories]);
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
