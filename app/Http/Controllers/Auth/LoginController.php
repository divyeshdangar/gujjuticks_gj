<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        if (Auth::check()) {
            $message = [
                "message" => [
                    "type" => "info",
                    "title" => __('dashboard.wait'),
                    "description" => __('dashboard.already_login')    
                ]
            ];
            return redirect()->route('dashboard')->with($message);
        } else {
            // to set meta data of page
            $metaData = [
                "title" => "Login to GujjuTicks",
                "description" => "Reach out to GujjuTicks easily with our contact form or contact information. Whether you have questions, feedback, or inquiries, we're here to assist you promptly. Connect with us now!",
                //"image" => "",
                "url" => route('login')
            ];
            return view('pages.auth.login', ['metaData' => $metaData]);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
