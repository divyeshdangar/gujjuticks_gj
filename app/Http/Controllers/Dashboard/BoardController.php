<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title"=>"Board", "route"=>""]
            ],
            "title" => ""
        ];
        $dataList = Board::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
        return view('dashboard.board.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

}
