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

        Log::error('OpenAI image generation failed', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }

    public function generateText(string $prompt, int $maxTokens = 1000): ?string
    {
        $response = Http::withToken($this->apiKey)
            ->post($this->endpoint['chatCompletion'], [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a content generator for social media and you must always return valid JSON arrays when asked.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => $maxTokens,
            ]);

        if ($response->successful()) {
            $content = $response['choices'][0]['message']['content'] ?? null;
            Log::info('OpenAI response', ['content' => $content]);
            return $content;
        }

        Log::error('OpenAI API Error', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }

    public function generatePosts(string $prompt, int $maxTokens = 1000): ?array
    {
        $response = Http::withToken($this->apiKey)
            ->post($this->endpoint['chatCompletion'], [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a content generator for social media and you must always return valid JSON. Do not add any markdown formatting.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => $maxTokens,
            ]);

        if ($response->successful()) {
            $content = $response['choices'][0]['message']['content'] ?? null;

            if ($content) {
                // Strip Markdown code fences if they exist
                $clean = preg_replace('/^```json|```$/m', '', $content);
                $clean = trim($clean);

                // Decode to array
                $data = json_decode($clean, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    Log::info('OpenAI response parsed', ['data' => $data]);
                    return $data;
                }

                Log::error('JSON decode failed', ['content' => $clean]);
            }
        }

        Log::error('OpenAI API Error', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        return null;
    }
}
