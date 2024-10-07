<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Social media", "route" => ""],
            ],
            "title" => "Social media"
        ];
        return view('dashboard.social.index', ['metaData' => $metaData]);
    }
}
