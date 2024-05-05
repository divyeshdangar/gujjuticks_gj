<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{

    public function index(Request $request)
    {
        $dataList = Image::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.image.index', ['dataList' => $dataList]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Image::find($id);
        if($dataDetail) {
            return view('dashboard.image.view', ['dataDetail' => $dataDetail]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard')->with($message);
        }
    }

    public function edit(Request $request, $id)
    {
        $dataList = Image::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.image.index', ['dataList' => $dataList]);
    }

    public function delete(Request $request, $id)
    {
        $dataList = Image::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.image.index', ['dataList' => $dataList]);
    }

}
