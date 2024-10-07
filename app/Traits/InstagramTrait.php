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
        'me' => '/me'
    ];

    private function request($type = 'get', $url, $params = [], $headers = [])
    {
        if ($type == "get") {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->get($url, $params);
        } else if ($type == "post") {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->post($url, $params);
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
        $response = $this->request("post", $url, $data, []);
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
            "domain" => $profile->access_token
        ];
        $response = $this->request("get", $url, $data, []);
        if ($response) {
            return $response;
        } else {
            return false;
        }
    }
}
