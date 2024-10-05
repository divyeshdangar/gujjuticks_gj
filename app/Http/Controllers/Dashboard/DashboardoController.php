<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardoController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.dashboard.home', ['metaData' => []]);
    }

}
