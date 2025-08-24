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

    public function createCarouselItem($profile, $imageUrl)
    {
        $url = $this->domain . $this->version . '/' . $profile->profile_user_id . $this->method["media"];
        $data = [
            'image_url'    => $imageUrl,
            'is_carousel_item' => true,
            'access_token' => $profile->access_token
        ];
        Log::info("Uploading carousel item", $data);
        return $this->request("post", $url, $data);
    }

    public function createCarouselContainer($profile, array $childrenIds, $caption = '')
    {
        $url = $this->domain . $this->version . '/' . $profile->profile_user_id . $this->method["media"];
        $data = [
            'caption'      => $caption,
            'children'     => implode(',', $childrenIds),
            'media_type'   => 'CAROUSEL',
            'access_token' => $profile->access_token
        ];
        Log::info("Creating carousel container", $data);
        return $this->request("post", $url, $data);
    }

    public function publishMedia($profile, $creationId)
    {
        $url = $this->domain . $this->version . '/' . $profile->profile_user_id . '/media_publish';
        $data = [
            'creation_id'  => $creationId,
            'access_token' => $profile->access_token
        ];
        Log::info("Publishing media", $data);
        return $this->request("post", $url, $data);
    }

    public function publishCarouselPost($profile, array $imageUrls, $caption = '', $maxRetries = 5, $retryDelay = 3)
    {
        $childrenIds = [];

        // --- Step 1: Upload each image as carousel item ---
        foreach ($imageUrls as $url) {
            $item = $this->createCarouselItem($profile, $url);

            if (!$item || !isset($item['id'])) {
                Log::error("Failed to upload carousel item", [
                    'url' => $url,
                    'response' => $item
                ]);
                return [
                    'success' => false,
                    'message' => 'Failed to upload carousel item',
                    'failed_url' => $url
                ];
            }

            $childrenIds[] = $item['id'];
        }

        // --- Step 2: Create carousel container ---
        $container = $this->createCarouselContainer($profile, $childrenIds, $caption);
        if (!$container || !isset($container['id'])) {
            Log::error("Failed to create carousel container", ['response' => $container]);
            return [
                'success' => false,
                'message' => 'Failed to create carousel container'
            ];
        }

        $creationId = $container['id'];

        // --- Step 3: Publish carousel container with retry ---
        $attempt = 0;
        $publishResponse = null;

        while ($attempt < $maxRetries) {
            $attempt++;
            $publishResponse = $this->publishMedia($profile, $creationId);

            if ($publishResponse && isset($publishResponse['id'])) {
                Log::info("Carousel post published successfully", ['id' => $publishResponse['id']]);
                return [
                    'success' => true,
                    'id' => $publishResponse['id'],
                    'message' => 'Carousel published successfully'
                ];
            }

            // If failed, wait before retrying
            Log::warning("Publish attempt {$attempt} failed, retrying in {$retryDelay} seconds...", [
                'creation_id' => $creationId,
                'response' => $publishResponse
            ]);
            sleep($retryDelay);
        }

        Log::error("Failed to publish carousel after {$maxRetries} attempts", [
            'creation_id' => $creationId,
            'response' => $publishResponse
        ]);

        return [
            'success' => false,
            'message' => 'Failed to publish carousel after multiple attempts',
            'last_response' => $publishResponse
        ];
    }

    public function getTokenDebugInfo($accessToken)
    {
        // You need your App Access Token to inspect user tokens
        $appId = config('services.instagram.INSTAGRAM_CLIENT_ID');
        $appSecret = config('services.instagram.INSTAGRAM_CLIENT_SECRET');
        $appAccessToken = $appId . '|' . $appSecret;

        $url = "https://graph.facebook.com/debug_token";
        $params = [
            'input_token' => $accessToken,
            'access_token' => $appAccessToken
        ];

        $response = $this->request("get", $url, $params);
        return $response ?: false;
    }

    public function estimateCarouselCapacityDynamic($profile, $itemsPerPost = 10, $defaultLimit = 200)
    {
        $tokenInfo = $this->getTokenDebugInfo($profile->access_token);

        // You can't directly fetch API call limits, but we can at least confirm token is valid
        if (!$tokenInfo || !isset($tokenInfo['data']['is_valid']) || !$tokenInfo['data']['is_valid']) {
            return [
                'success' => false,
                'message' => 'Token is invalid or expired. Using default limit estimate.',
                'estimated_posts' => (int) floor($defaultLimit / ($itemsPerPost + 2))
            ];
        }

        // Assume safe limit is $defaultLimit (200) unless you manually adjust based on experience
        $callsPerPost = $itemsPerPost + 2;
        $maxPosts = (int) floor($defaultLimit / $callsPerPost);

        return [
            'success' => true,
            'items_per_post' => $itemsPerPost,
            'calls_per_post' => $callsPerPost,
            'daily_limit' => $defaultLimit,
            'max_posts' => $maxPosts,
            'message' => "Token valid. You can safely publish up to {$maxPosts} full carousel posts per day with {$itemsPerPost} images each."
        ];
    }
}
