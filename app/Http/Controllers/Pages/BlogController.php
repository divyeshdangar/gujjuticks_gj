<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        // to set meta data of page
        $metaData = [
            "title" => "Get in Touch: Contact GujjuTicks",
            "description" => "Reach out to GujjuTicks easily with our contact form or contact information. Whether you have questions, feedback, or inquiries, we're here to assist you promptly. Connect with us now!",
            //"image" => "",
            "url" => route('pages.blog.list')
        ];

        return view('pages.blog.list', ['metaData' => $metaData, 'metaData' => []]);
    }

    public function view(Request $request, $slug)
    {
        $dataDetail = Blog::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => "GujjuTicks - " . $dataDetail->title,
                "no_title" => true,
                "description" => "",
                //"image" => "",
                "url" => route('pages.blog.detail', ['slug' => $dataDetail->slug]),
                "breadCrumb" => [
                    ["title" => "Board", "route" => "dashboard.board"],
                    ["title" => "Create", "route" => ""]
                ]
            ];
            return view('pages.blog.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
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
