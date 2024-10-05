<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    public function privacy(Request $request): View
    {
        // to set meta data of page
        $metaData = [
            "title" => "Privacy Policy for GujjuTicks.com",
            "description" => "At GujjuTicks.com, we respect your privacy and are committed to protecting your personal information. This Privacy Policy outlines how we collect, use, and safeguard your data when you visit our website.",
            //"image" => "",
            "url" => route('p.privacy-policy')
        ];     
        return view('pages.p.privacy', ['metaData' => $metaData]);
    }
}
