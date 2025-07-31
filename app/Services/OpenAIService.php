<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected string $apiKey;

    protected array $endpoint = [
        'imageGeneration' => 'https://api.openai.com/v1/images/generations',
        'chatCompletion'  => 'https://api.openai.com/v1/chat/completions',
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
            return $response['data'][0]['url'];
        }

        return null;
    }

    public function generateText(string $prompt): ?string
    {
        $response = Http::withToken($this->apiKey)
            ->post($this->endpoint['chatCompletion'], [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
            ]);

        if ($response->successful()) {
            Log::info($response);
            return $response['choices'][0]['message']['content'] ?? null;
        }

        // Log full error response
        \Log::error('OpenAI API Error', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        return null;
    }
}
