<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\PlaceCategory;
use App\Models\Blog;

class HomeController extends Controller
{
    public $languages = [
        'e' => 'English',
        'h' => 'हिन्दी',
        'g' => 'ગુજરાતી'
    ];
    public function show(Request $request): View
    {
        $metaData = [];
        $categories = PlaceCategory::withCount('businesses')->where('is_active', '1')->get();
        $dataList = Blog::where('status', '1')->orderBy('id', 'DESC')->limit(3)->get();

        return view('welcome', ['metaData' => $metaData, 'lang' => $this->languages, 'categories' => $categories, 'dataList' => $dataList]);
    }
}
