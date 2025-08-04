<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\WorkItemCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Board", "route" => ""]
            ],
            "title" => "Board"
        ];
        $dataList = Board::orderBy('id', 'DESC')->where('user_id', Auth::id());
        $dataList = $dataList->searching()->paginate(3)->withQueryString();
        return view('dashboard.board.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }
    
    public function create(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Board", "route" => "dashboard.board"],
                ["title" => "Create", "route" => ""]
            ],
            "title" => "Create Board"
        ];
        return view('dashboard.board.create', ['metaData' => $metaData]);
    }

    public function view(Request $request, $id)
    {
        $dataDetail = Board::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Board", "route" => "dashboard.board"],
                    ["title" => "Board Items", "route" => ""]
                ],
                "title" => "Board Items"
            ];

            $populatedData = [];

            if ($dataDetail->categories) {
                foreach ($dataDetail->categories as $key => $value) {
                    $temp = [
                        "id" => "BRD-" . $value->id,
                        "title" => $value->title,
                        "class" => "text-light,rounded-3,bg-dark,ct_bg_color_" . $value->id,
                        "item" => []
                    ];

                    if ($value->items) {
                        foreach ($value->items as $key_item => $value_item) {
                            $temp["item"][] = (object)[
                                "id" => $value_item->slug,//"IT_" . $value_item->id,
                                "title" => ((string)View::make('dashboard.board.card', ["item" => $value_item]))
                            ];
                        }
                    }
                    $populatedData[] = (object)$temp;
                }
            }
            return view('dashboard.board.view', ['dataDetail' => $dataDetail, 'populatedData' => $populatedData, 'metaData' => $metaData]);
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
        $dataDetail = Board::find($id);
        if($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Board", "route" => "dashboard.board"],
                    ["title" => "Edit", "route" => ""],
                ],
                "title" => "Edit Board"
            ];
            return view('dashboard.board.edit', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
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

    public function store(Request $request, $id)
    {         
        $dataDetail = ($id > 0) ? Board::find($id) : new Board;
        if($dataDetail) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'description' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect('dashboard/board/edit/'.$id)->withErrors($validator)->withInput();
            }    
            $dataToInsert = $validator->validated();
            $dataDetail->title = $dataToInsert['title'];
            $dataDetail->slug = "";
            $dataDetail->user_id = Auth::id();
            $dataDetail->description = $dataToInsert['description'];
            $dataDetail->save();

            if(!$dataDetail->categories || ($dataDetail->categories && count($dataDetail->categories) == 0)) {
                $this->addDefaultBoardCategory($dataDetail->id);
            }

            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
            return redirect()->route('dashboard.board')->with($message);
        } else {
            return redirect()->route('dashboard.board');
        }
    }

    private function addDefaultBoardCategory($board_id) {
        $data = [
            [ 'title' => 'To Do' ],
            [ 'title' => 'In Progress' ],
            [ 'title' => 'Completed' ]
        ];        
        $timestamp = Carbon::now();        
        foreach ($data as &$record) {            
            $record['board_id'] = $board_id;
            $record['user_id'] = Auth::id();
            $record['created_at'] = $timestamp;
            $record['updated_at'] = $timestamp;
        }
        WorkItemCategory::insert($data);
        $message = [
            "message" => [
                "type" => "success",
                "title" => __('dashboard.great'),
                "description" => __('dashboard.details_submitted')
            ]
        ];
        return redirect()->route('dashboard.board')->with($message);
    } 

    public function delete(Request $request, $id)
    {        
        $dataDetail = Board::find($id);
        if ($dataDetail) {

            if(count($dataDetail->categories) > 0 || count($dataDetail->items) > 0 ){
                $message = [
                    "message" => [
                        "type" => "error",
                        "title" => __('dashboard.bad'),
                        "description" => __('dashboard.board_not_empty')
                    ]
                ];
                return redirect()->route('dashboard.board')->with($message);
            } else {
                $dataDetail->delete();
                $message = [
                    "message" => [
                        "type" => "success",
                        "title" => __('dashboard.great'),
                        "description" => __('dashboard.record_deleted')
                    ]
                ];
                return redirect()->route('dashboard.board')->with($message);
            }
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.board')->with($message);
        }
    }

}
