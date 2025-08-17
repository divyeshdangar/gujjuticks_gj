<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RssFeedController extends Controller
{
    public function view(Request $request, $slug)
    {

        $userAgent = request()->header('User-Agent');
        if (stripos($userAgent, 'Pinterest') !== false) {
        
        }

        switch ($slug) {
            case 'pintrest-blogs':

                $blogs = \App\Models\Blog::limit(5)->get();
                return response()
                    ->view('rss.feed', compact('blogs'))
                    ->header('Content-Type', 'application/rss+xml');

                break;

            default:
                # code...
                break;
        }
    }
}
