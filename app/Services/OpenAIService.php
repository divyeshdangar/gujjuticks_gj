<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected string $apiKey;

    protected array $endpoint = [
        'imageGeneration' => 'https://api.openai.com/v1/images/generations'
    ];    

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
    }

    public function generateImage(string $prompt, string $size = '1024x1024'): ?string
    {
        $response = Http::withToken($this->apiKey)->post($this->endpoint['imageGeneration'], [
            'prompt' => $prompt,
            'n' => 1,
            'size' => $size,
        ]);

        if ($response->successful() && isset($response['data'][0]['url'])) {
            Log::info($response);
            return $response['data'][0]['url'];
        }

        dd($response->body());

        return null;
    }
}
