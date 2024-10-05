<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InstagramController extends Controller
{
    // Here we get comments,live_comments,message_reactions,messages,messaging_optins,messaging_postbacks,messaging_referral,messaging_seen
    public function handleInstagramCallback(Request $request)
    {
        try {
            Log::alert($request);
        } catch (\Throwable $th) {
            Log::alert($th);
        }
        if ($_REQUEST['hub_verify_token'] && ($_REQUEST['hub_verify_token'] == '5076065b123775a2a4496fa60c823cdc6a16d9271cb8e643f37e3de7121b8921')) {
            echo $_REQUEST['hub_challenge'];
        } else {
            echo 'Invalid Verify Token';
        }
    }

    // In order to set up business login, please provide a redirect URL. This is the location that users will be redirected to after completing the login flow.
    public function handleInstagramAfterLoginCallback(Request $request)
    {
        try {
            Log::info($request);
        } catch (\Throwable $th) {
            Log::info($th);
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
