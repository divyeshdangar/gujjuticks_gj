<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function show(Request $request): View
    {
        // to set meta data of page
        $metaData = [];

        return view('welcome', ['metaData' => $metaData, 'metaData' => []]);
    }
}
