<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    
    public $memberType = [
        "-1" => "dashboard.rejected",
        "0" => "dashboard.pending",
        "1" => "dashboard.confirm",
        "2" => "dashboard.deleted"
    ];

    public function index(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => __('dashboard.member'), "route" => ""]
            ],
            "title" => __('dashboard.member')
        ];
        $dataList = Member::orderBy('id', 'DESC');
        $dataList = $dataList->searching()->where('user_id', Auth::id())->paginate(10)->withQueryString();
        foreach ($dataList as $key => $value) {
            $class = "text-bg-primary";
            switch ($value->status) {
                case '-1':
                    $class = "text-bg-warning";
                    break;
                case '0':
                    $class = "text-bg-info";
                    break;
                case '1':
                    $class = "text-bg-success";
                    break;
                case '2':
                    $class = "text-bg-danger";
                    break;
                                                            
                default:
                    # code...
                    break;
            }
            $value->status = '<span class="badge '.$class.' py-1 px-2 text-white rounded-1 fw-semibold fs-12">'.__($this->memberType[$value->status]).'</span>';
        }
        return view('dashboard.member.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function store(Request $request)
    {         
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
            'createNew' => 'sometimes',
            'createAndAccept' => 'bail|required_if:createNew,=,1'
        ]);
        
        if ($validator->fails()) {
            return redirect('dashboard/member')->withErrors($validator)->withInput();
        }    

        $dataDetail = new Member;
        $dataToInsert = $validator->validated();

        $data = Member::where([
            "email" => $dataToInsert['email'],
            "user_id" => Auth::id()
        ])->get();

        if($data->count() > 0) {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.wait'),
                    "description" => __('dashboard.already_requested')
                ]
            ];
        } else {
            $dataDetail->email = $dataToInsert['email'];
            $dataDetail->user_id = Auth::id();
    
            $user = User::whereEmail($dataToInsert['email'])->first();
            if($user){
                $dataDetail->member_id = $user->id;
                $data = [
                    'message_tag' => 'msg.new_member_request',
                    'user_id' => $user->id,
                    'user_id2' => Auth::id(),
                ];
                Notification::create($data);
            } else {

            }
            $dataDetail->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
        }

        return redirect()->route('dashboard.member')->with($message);
    }


    public function status(Request $request, $id, $status)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
        ]);
        
        if ($validator->fails()) {
            return redirect('dashboard/member')->withErrors($validator)->withInput();
        }    

        $dataDetail = new Member;
        $dataToInsert = $validator->validated();

        $data = Member::where([
            "email" => $dataToInsert['email'],
            "user_id" => Auth::id()
        ])->get();

        if($data->count() > 0) {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.wait'),
                    "description" => __('dashboard.already_requested')
                ]
            ];
        } else {
            $dataDetail->email = $dataToInsert['email'];
            $dataDetail->user_id = Auth::id();
    
            $user = User::whereEmail($dataToInsert['email'])->first();
            if($user){
                $dataDetail->member_id = $user->id;
                $data = [
                    'message_tag' => 'msg.new_member_request',
                    'user_id' => $user->id,
                    'user_id2' => Auth::id(),
                ];
                Notification::create($data);
            }
            $dataDetail->save();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.great'),
                    "description" => __('dashboard.details_submitted')
                ]
            ];
        }

        return redirect()->route('dashboard.member')->with($message);
    }

}
