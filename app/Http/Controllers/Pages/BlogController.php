<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        // to set meta data of page
        $metaData = [
            "title" => "Get in Touch: Contact GujjuTicks",
            "description" => "Reach out to GujjuTicks easily with our contact form or contact information. Whether you have questions, feedback, or inquiries, we're here to assist you promptly. Connect with us now!",
            //"image" => "",
            "url" => route('form.contact')
        ];

        return view('pages.blog.list', ['metaData' => $metaData, 'metaData' => []]);
    }
}
