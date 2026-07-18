<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Notification", "route" => ""]
            ],
            "title" => "Notification"
        ];

        $dataList = Notification::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->where('user_id', Auth::id())->paginate(10)->withQueryString();
        
        if($dataList->count() > 0) {
            foreach ($dataList as $key => $value) {

                $data = [
                    "user" => ($value->user) ? ucwords($value->user->name) : "",
                    "user2" => ($value->user2) ? ucwords($value->user2->name) : "",
                    "extra" => ($value->extra($value->message_tag)) ? $value->extra($value->message_tag)->title : "",
                ];
                $value->msg = __($value->message_tag, $data);
            }
        }
        return view('dashboard.user.notification', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function action(Request $request, $action)
    {
        $message = [
            "message" => [
                "type" => "error",
                "title" => __('dashboard.bad'),
                "description" => __('dashboard.no_record_found')
            ]
        ];

        return redirect()->route('dashboard.notification')->with($message);
    }
}
