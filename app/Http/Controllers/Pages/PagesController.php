<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pages;

class PagesController extends Controller
{
    public function view(Request $request, $slug)
    {
        $dataDetail = Pages::where("slug", $slug)->first();
        if ($dataDetail) {
            // to set meta data of page
            $metaData = [
                "title" => $dataDetail["title"],
                "description" => $dataDetail["meta_description"],
                //"image" => "",
                "url" => route('p.pages',["slug" => $dataDetail["slug"]])
            ];  
            return view('pages.p.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
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
