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
            return view('pages.auth.login');
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
