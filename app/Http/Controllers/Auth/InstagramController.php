<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\InstagramTrait;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class InstagramController extends Controller
{
    use InstagramTrait;

    // Here we get comments,live_comments,message_reactions,messages,messaging_optins,messaging_postbacks,messaging_referral,messaging_seen
    public function handleInstagramCallback(Request $request)
    {
        try {
            Log::alert($request);
        } catch (\Throwable $th) {
            Log::alert($th);
        }
        if ($_REQUEST['hub_verify_token'] && ($_REQUEST['hub_verify_token'] == '')) {
            echo $_REQUEST['hub_challenge'];
        } else {
            echo 'Invalid Verify Token';
        }
    }

    // In order to set up business login, please provide a redirect URL. This is the location that users will be redirected to after completing the login flow.
    public function handleInstagramAfterLoginCallback(Request $request)
    {
        if($request->query('code') && $request->query('code')!=""){
            $response = $this->getUserDetail($request->query('code'));
            if($response) {

                $profile = Profile::where("profile_user_id", $response->user_id)->first();
                if(!$profile) {
                    $profile = new Profile();
                    $profile->user_id = Auth::id();
                    $profile->access_token = $response->access_token;
                    $profile->profile_id = $response->user_id;
                    $profile->permissions = implode(', ', $response->permissions);
                    $profile->last_update_time = time();
                    $profile->save();
                }
                
                //get instagram account details
                $response = $this->getInstagramAccountDetail($profile);
                if($response) {
                    $profile->profile_user_id = $response->user_id;
                    $profile->username = $response->username;
                    $profile->name = $response->name;
                    $profile->profile_pic = $response->profile_picture_url;
                    $profile->followers = $response->followers_count;
                    $profile->follows = $response->follows_count;
                    $profile->media = $response->media_count;
                    $profile->account_type = $response->account_type;
                    $profile->last_update_time = time();
                    $profile->save();
                }
                echo "SUCCESS";
            } else {
                echo "NOUSERDETAIL";
            }
        } else {
            echo "NOCODE";
        }
    }

    // Deauthorize callback URL
    public function handleInstagramDeauthorizeCallback(Request $request)
    {
        Log::info("Deauthorize callback URL");
        try {
            Log::info($request);
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }

    // Data deletion request URL
    public function handleInstagramDeletionCallback(Request $request)
    {
        Log::info("Data deletion request URL");
        try {
            Log::info($request);
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }
}
