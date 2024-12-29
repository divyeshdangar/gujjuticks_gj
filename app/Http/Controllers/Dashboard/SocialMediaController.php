<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\InstagramTrait;
use Illuminate\Support\Facades\Log;


class SocialMediaController extends Controller
{
    use InstagramTrait;

    // In order to set up business login, please provide a redirect URL. This is the location that users will be redirected to after completing the login flow.
    public function handleInstagramAfterLoginCallback(Request $request)
    {
        if ($request->query('code') && $request->query('code') != "") {
            $response = $this->getUserDetail($request->query('code'));
            if ($response) {
                $profile = Profile::where("profile_id", $response["user_id"])->first();
                if (!$profile) {
                    $profile = new Profile();
                    $profile->user_id = Auth::id();
                    $profile->access_token = $response["access_token"];
                    $profile->permissions = implode(', ', $response["permissions"]);
                }

                //get instagram account details
                $response = $this->getInstagramAccountDetail($profile);
                if ($response) {
                    $profile->profile_id = $response["id"];
                    $profile->profile_user_id = $response["user_id"];
                    $profile->username = $response["username"];
                    $profile->name = $response["name"];
                    $profile->profile_pic = $response["profile_picture_url"];
                    $profile->followers = $response["followers_count"];
                    $profile->follows = $response["follows_count"];
                    $profile->media = $response["media_count"];
                    $profile->account_type = $response["account_type"];

                    $response2 = $this->getInstagramLongLivedToken($profile);
                    if ($response2) {
                        $profile->access_token = $response2["access_token"];
                    }
                }

                try {
                    $profile->last_update_time = time();
                    $profile->save();
                    $message = [
                        "message" => [
                            "type" => "success",
                            "title" => __('dashboard.great'),
                            "description" => __('dashboard.details_submitted')
                        ]
                    ];
                } catch (\Throwable $th) {
                    $message = [
                        "message" => [
                            "type" => "error",
                            "title" => __('dashboard.bad'),
                            "description" => __('dashboard.no_record_found')
                        ]
                    ];
                }
            } else {
                $message = [
                    "message" => [
                        "type" => "error",
                        "title" => __('dashboard.bad'),
                        "description" => __('dashboard.no_record_found')
                    ]
                ];
            }
        } else {
            $message = [
                "message" => [
                    "type" => "error",
                    "title" => __('dashboard.bad'),
                    "description" => __('dashboard.no_record_found')
                ]
            ];
        }
        return redirect()->route('dashboard.social')->with($message);
    }

    public function index(Request $request)
    {
        $dataList = Profile::orderBy('id', 'DESC')->where('user_id', Auth::id());
        $dataList = $dataList->searching()->paginate(10)->withQueryString();        

        $metaData = [
            "breadCrumb" => [
                ["title" => "Social media", "route" => ""],
            ],
            "title" => "Social media"
        ];
        return view('dashboard.social.index', ['dataList' => $dataList, 'metaData' => $metaData]);
    }

    public function detail(Request $request, $id)
    {
        $dataDetail = Profile::find($id);
        if ($dataDetail) {            
            $response = $this->getInstagramAccountPostList($dataDetail);
            echo "<pre>";
            print_r($response);

            die;
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

    public function view(Request $request, $id)
    {
        $dataDetail = Profile::find($id);
        if ($dataDetail) {
            $metaData = [
                "breadCrumb" => [
                    ["title" => "Social media", "route" => "dashboard.social"],
                    ["title" => "Detail", "route" => ""]
                ],
                "title" => "Social media Detail"
            ];
            return view('dashboard.social.view', ['dataDetail' => $dataDetail, 'metaData' => $metaData]);
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

}
