<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Webpage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WebpageController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => __('dashboard.webpage'), "route" => ""]
            ],
            "title" => __('dashboard.webpage')
        ];
        $dataList = Webpage::withTrashed()->orderBy('id', 'DESC')->where('user_id', Auth::id());
        $dataList = $dataList->searching()->paginate(10)->withQueryString();

        return view('dashboard.webpage.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function edit(Request $request, $id)
    {
        $dataDetail = Webpage::find($id);
        if($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Webpage", "route" => "dashboard.webpage"],
                    ["title" => "Edit", "route" => ""]
                ],
                "title" => "Edit Webpage"
            ];
            return view('dashboard.webpage.edit', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'link' => 'required|min:4|max:255|unique:webpages,link',
            'description' => 'sometimes'
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/webpage')->withErrors($validator)->withInput();
        }

        $dataToInsert = $validator->validated();
        $data = [
            'title' => $dataToInsert['title'],
            'link' => $dataToInsert['link'],
            'description' => $dataToInsert['description'],
            'user_id' => Auth::id()
        ];

        $webpage = Webpage::create($data);
        if (!empty($webpage) && isset($webpage->id)) {
            $data = [
                'message_tag' => 'msg.new_webpage_created',
                'user_id' => Auth::id(),
                'extra_id' => $webpage->id
            ];
            Notification::create($data);
        }

        $message = [
            "message" => [
                "type" => "success",
                "title" => __('dashboard.great'),
                "description" => __('dashboard.details_submitted')
            ]
        ];
        return redirect()->route('dashboard.webpage')->with($message);
    }

    public function delete(Request $request, $id)
    {        
        $dataDetail = Webpage::find($id);
        if ($dataDetail) {
            $dataDetail->delete();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_deleted')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }

    public function restore(Request $request, $id)
    {        
        $dataDetail = Webpage::withTrashed()->find($id);
        if ($dataDetail) {
            $dataDetail->deleted_at = Null;
            $dataDetail->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.record_restored')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
            return redirect()->route('dashboard.webpage')->with($message);
        }
    }

}
