<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Models\Webpage;
use App\Models\Template;
use App\Models\IndustryType;
use App\Models\WebpageLink;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class GujjuMeController extends Controller
{
    public function index(Request $request): View
    {
        $metaData = [
            "title" => "Gujju.me | One Link, Infinite Possibilities, for the Gujarati in You | GujjuTicks Link Page Builder",
            "description" => "Share your Gujju.Me links, showcase your products, and grow your presence – all from one beautiful, personalized page powered by GujjuTicks.",
            //"image" => "",
            "keywords" => "gujju.me, gujjuticks bio link, Gujarati linktree alternative, bio link for Gujarati creators, social media link page, WhatsApp product showcase, one link page for small business, Gujarati digital identity, link in bio for WhatsApp, small business link page",
            "url" => route('pages.link.index')
        ];
        return view('pages.link.index', ['metaData' => $metaData]);
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|max:255|regex:/^[a-zA-Z](?!.*--)[a-zA-Z0-9-]{2,}[a-zA-Z0-9]$/',
        ]);

        if ($validator->fails()) {
            return redirect()->to(route('pages.link.index') . '#reserve-link-now')
                ->withErrors($validator)
                ->withInput();
        }

        $exists = Webpage::where('link', $request->input('username'))->exists();

        if ($exists) {
            return redirect()->to(route('pages.link.index') . '#reserve-link-now')
                ->withErrors(['username' => 'This username is already taken.'])
                ->withInput();
        } else {
            $unique = $request->input('unique');
            $username = $request->input('username');
            if ($unique && $username) {
                $decUsername = Crypt::decryptString($unique);
                if ($username == $decUsername) {
                    $web = new Webpage();
                    $web->user_id = Auth::id();
                    $web->link = $username;
                    $web->template_id = 1;
                    $web->title = "";
                    $web->save();

                    $message = [
                        "message" => [
                            "type" => "success",
                            "title" => __('dashboard.great'),
                            "description" => __('dashboard.details_submitted')
                        ]
                    ];
                    return redirect()->route('home')->with($message);
                }
            }
        }

        // If valid and not taken, redirect back with success
        return redirect()->to(route('pages.link.index') . '#reserve-link-now')
            ->with('success', 'Username is available!')
            ->withInput();
    }
}
