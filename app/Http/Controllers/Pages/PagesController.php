<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PagesController extends Controller
{
    public function view(Request $request, string $slug): View|RedirectResponse
    {
        $dataDetail = Pages::where('slug', $slug)->first();

        if (!$dataDetail) {
            return redirect()->route('home')->with([
                'message' => [
                    'type' => 'error',
                    'title' => __('dashboard.bad'),
                    'description' => __('dashboard.no_record_found'),
                ],
            ]);
        }

        $metaData = [
            'title' => $dataDetail->title,
            'description' => $dataDetail->meta_description,
            'url' => route('p.pages', ['slug' => $dataDetail->slug]),
        ];

        if (!empty($dataDetail->image) && $dataDetail->image !== 'default.png') {
            $metaData['image'] = asset('images/pages/' . $dataDetail->image);
        }

        return view('pages.p.view', [
            'dataDetail' => $dataDetail,
            'metaData' => $metaData,
        ]);
    }
}
