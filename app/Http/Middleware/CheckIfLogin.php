<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class CheckIfLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Language logic :Temporary added here
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        if (Auth::check()) {
            $adminOnly = ['dashboard/contact', 'dashboard/image'];
            if(in_array($request->route()->uri(), $adminOnly) && Auth::user()->email!='gujjuticks@gmail.com'){
                $message = [
                    "message" => [
                        "type" => "error",
                        "title" => __('dashboard.bad'),
                        "description" => __('dashboard.for_admin_only')
                    ]
                ];
                return redirect()->route('dashboard')->with($message);
            }
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
