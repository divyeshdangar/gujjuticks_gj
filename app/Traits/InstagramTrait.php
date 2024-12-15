<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait InstagramTrait
{
    private $domain = 'https://graph.instagram.com';
    private $domain_access_token = 'https://api.instagram.com/oauth/access_token';
    private $version = '/v21.0';
    private $method = [
        'me' => '/me',
        'access_token' => '/access_token',
        'refresh_access_token' => '/refresh_access_token',
        'media' => '/media'
    ];

    private function request($type = 'get', $url, $params = [], $headers = [])
    {
        if ($type == "get") {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get($url, $params);
        } else if ($type == "post") {
            Log::alert($params);
            $response = Http::asForm()->post($url, $params);
        } else {
            return false;
        }

        if ($response->successful()) {
            return $response->json();
        } else {
            Log::info($response);
            return false;
        }
    }

    public function getUserDetail($code)
    {
        $url = $this->domain_access_token;
        $data = [
            "client_id" => config('services.instagram.INSTAGRAM_CLIENT_ID'),
            "client_secret" => config('services.instagram.INSTAGRAM_CLIENT_SECRET'),
            "grant_type" => "authorization_code",
            "redirect_uri" => config('services.instagram.INSTAGRAM_REDIRECT_URL'),
            "code" => $code
        ];
        Log::warning($data);
        $response = $this->request("post", $url, $data, []);
        Log::error($response);
        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function getInstagramAccountDetail($profile)
    {
        $url = $this->domain . $this->version . $this->method["me"];
        $data = [
            "fields" => "id,user_id,username,name,profile_picture_url,followers_count,follows_count,media_count,account_type",
            "access_token" => $profile->access_token
        ];
        Log::warning($data);
        $response = $this->request("get", $url, $data, []);
        Log::error($response);
        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function getInstagramLongLivedToken($profile)
    {
        $url = $this->domain . $this->method["access_token"];
        $data = [
            "grant_type" => "ig_exchange_token",
            "client_secret" => config('services.instagram.INSTAGRAM_CLIENT_SECRET'),
            "access_token" => $profile->access_token
        ];
        Log::warning($data);
        $response = $this->request("get", $url, $data, []);
        Log::error($response);
        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function refreshInstagramLongLivedToken($profile)
    {
        $url = $this->domain . $this->method["refresh_access_token"];
        $data = [
            "grant_type" => "ig_refresh_token",
            "access_token" => $profile->access_token
        ];
        Log::warning($data);
        $response = $this->request("get", $url, $data, []);
        Log::error($response);
        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function getInstagramAccountPostList($profile)
    {
        $url = $this->domain . $this->version . '/' . $profile->profile_user_id . $this->method["media"];
        $data = [
            "fields" => "id,caption,media_type,media_url,thumbnail_url,timestamp,permalink,username,like_count,comments_count,is_comment_enabled,children",
            "access_token" => $profile->access_token
        ];
        Log::warning($url);
        Log::warning($data);
        $response = $this->request("get", $url, $data, []);
        Log::error($response);
        if ($response) {
            return $response;
        } else {
            return false;
        }
    }
}
