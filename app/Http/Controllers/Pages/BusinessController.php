<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\PlaceCategory;
use App\Models\City;
use URL;

class BusinessController extends Controller
{
    public function add(Request $request): View
    {
        $categories = PlaceCategory::where('is_active', '1')->orderBy('name', 'ASC')->get();
        $cities = City::orderBy('name', 'ASC')->get();
        $metaData = [
            "title" => "Add Your Business - Get Listed in GujjuTicks Business Directory",
            "description" => "List your business for free in our city directory. Increase visibility, attract local customers, and grow your brand online in just a few minutes.",
            //"image" => "",
            "keywords" => "add business, list business online, city business directory, local listing, free business listing, promote business, online directory, business registration",
            "url" => route('pages.business.add')
        ];
        return view('pages.business.add', ['metaData' => $metaData, 'cities' => $cities, 'categories' => $categories]);
    }
}
