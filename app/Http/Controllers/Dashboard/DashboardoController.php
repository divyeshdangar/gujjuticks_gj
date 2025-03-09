<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMenu;
use App\Models\Menu;

class DashboardoController extends Controller
{
    public function index(Request $request)
    {

        $menuList = Menu::where('status', '1')->where('type', '2')->where('order', '>', 0);
        if (Auth::user()->user_type == 1) {
            // All Access
        } else {
            $in = [];
            if (!empty(Auth::user()->menus)) {
                $in = explode(',', Auth::user()->menus->menuIds);
            }
            $menuList = $menuList->whereIn('id', $in);
        }
        $menuList = $menuList->orderBy('order', 'ASC')->get();
        return view('pages.dashboard.home', ['metaData' => [], 'menu' => $menuList]);
    }
}
