<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Webpage;
use App\Models\Template;
use App\Models\IndustryType;
use App\Models\WebpageLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class WebpageAnalyticsController extends Controller
{
    public function index(Request $request, $id)
    {
        $dataDetail = Webpage::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Webpage", "route" => "dashboard.webpage"],
                    ["title" => "Analytics", "route" => ""]
                ],
                "title" => "Analytics"
            ];
            return view('dashboard.webpage.analytics', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }
}
