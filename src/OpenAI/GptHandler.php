<?php

namespace JamesBlackwell\ArtisanAI\OpenAI;

use Illuminate\Support\Facades\Http;

class GptHandler
{
    private $apiKey;

    private $model;

    private $timeout;

    public function __construct()
    {
        $this->apiKey = config('artisan-ai.openai_api_key');
        $this->model = config('artisan-ai.openai_model', 'gpt-4');
        $this->timeout = config('artisan-ai.openai_timeout', 60);
    }

    public function generateCode(string $input, string $systemPrompt)
    {
        $messages = [
            ["role" => "system", "content" => $systemPrompt],
            ["role" => "user", "content" => $input]
        ];

        // Log debug messages
        \Log::debug('OpenAI GPT API request', [
            'model' => $this->model,
            'messages' => $messages,
            'max_tokens' => 1000,
            'temperature' => 0.6,
        ]);

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type' => 'application/json',
        ])
            ->timeout($this->timeout)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => $this->model,
                'messages' => $messages,
                'max_tokens' => 500,
                'temperature' => 0.5,
            ]);

        $responseBody = $response->json();

        return $responseBody['choices'][0]['message']['content'];
    }
}
