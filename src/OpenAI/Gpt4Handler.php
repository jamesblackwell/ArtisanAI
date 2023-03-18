<?php

namespace JamesBlackwell\ArtisanAI\OpenAI;

use Illuminate\Support\Facades\Http;

class Gpt4Handler
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('artisan-ai.openai_api_key');
    }

    public function generateCode(string $input, string $systemPrompt)
    {
        $messages = [
            ["role" => "system", "content" => $systemPrompt],
            ["role" => "user", "content" => $input]
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4',
            'messages' => $messages,
            'max_tokens' => 500,
            'temperature' => 0.5,
        ]);

        $responseBody = $response->json();
        $code = $responseBody['choices'][0]['message']['content'];

        // Remove lines starting with backticks
        $filteredCode = preg_replace('/^`{1,3}.*$/m', '', $code);

        return $filteredCode;
    }
}
