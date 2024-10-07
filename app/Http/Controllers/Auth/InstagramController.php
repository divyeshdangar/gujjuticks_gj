<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\InstagramTrait;

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
        if ($_REQUEST['hub_verify_token'] && ($_REQUEST['hub_verify_token'] == config('services.instagram.INSTAGRAM_HUB_VERIFY_TOKEN'))) {
            echo $_REQUEST['hub_challenge'];
        } else {
            echo 'Invalid Verify Token';
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
