<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Member;
use App\Models\User;
use App\Jobs\ProcessMemberImport;
use App\Models\ImportRecord;
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
        $dataList = Member::orderBy('id', 'DESC')->where('user_id', Auth::id());
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
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

    public function import(Request $request)
    {
        $metaData = [
            "breadCrumb" => [
                ["title" => "Member", "route" => "dashboard.member"],
                ["title" => "Import", "route" => ""]
            ],
            "title" => "Import member"
        ];
        $dataList = ImportRecord::orderBy('id', 'DESC')->where('user_id', Auth::id());
        $dataList = $dataList->searching()->paginate(10)->withQueryString();
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
        return view('dashboard.member.import', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function store(Request $request)
    {         
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:255|email',
            'createNew' => 'sometimes',
            'createAndAccept' => 'sometimes',
            'firstname' => 'bail|required_if:createNew,=,1',
            'lastname' => 'bail|required_if:createNew,=,1',
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
                if (array_key_exists("createNew", $dataToInsert)) {
                    $data = [
                        'name' => $dataToInsert['firstname']." ".$dataToInsert['lastname'], 
                        'first_name' => $dataToInsert['firstname'], 
                        'last_name' => $dataToInsert['lastname'], 
                        'email' => $dataToInsert['email'], 
                        'login_type' => 'SL',
                        'profile' => 'default.png',
                        'password' => \Hash::make(rand(100000, 999999))
                    ];
                    $user = User::create($data);
                    if(isset($user->id)){
                        $dataDetail->member_id = $user->id;
                        if (array_key_exists("createAndAccept", $dataToInsert)) {
                            $dataDetail->status = 1;
                        }
                        $data = [
                            'message_tag' => 'msg.new_member_request',
                            'user_id' => $user->id,
                            'user_id2' => Auth::id(),
                        ];
                        Notification::create($data);
                    }
                }
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

    public function import_file(Request $request)
    {         
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xlsx'
        ]);
        
        if ($validator->fails()) {
            return redirect('dashboard/member/import')->withErrors($validator)->withInput();
        }    

        $dataDetail = new ImportRecord;

        $fileName = time().'-'.rand(0, time()).'.xlsx';
        $request->excel_file->storeAs('import/member', $fileName, 'public');

        $dataDetail->model = 'Member';
        $dataDetail->user_id = Auth::id();
        $dataDetail->file = $fileName;
        $dataDetail->file_original_name = $request->excel_file->getClientOriginalName();
        $dataDetail->status = '0';
        $dataDetail->notes = '';
        $dataDetail->save();

        if(isset($dataDetail->id)){
            dispatch(new ProcessMemberImport($dataDetail, Auth::id()));
        }
        $message = [
            "message" => [
                "type" => "success",
                "title" => __('dashboard.great'),
                "description" => __('dashboard.details_submitted')
            ]
        ];

        return redirect()->route('dashboard.member.import')->with($message);
    }

}
