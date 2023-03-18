<?php

namespace JamesBlackwell\ArtisanAI\Console;

use Illuminate\Console\Command;
use JamesBlackwell\ArtisanAI\OpenAI\GptHandler;


class GenerateMigrationCommand extends Command
{
    protected $signature = 'ai:migration {input}';

    protected $description = 'Generate migration file using OpenAI GPT-4 API';

    public function handle()
    {
        $input = $this->argument('input');
        $apiKey = config('artisan-ai.openai_api_key');

        if (!$apiKey) {
            $this->error('Please set your OPENAI_API_KEY in the .env file.');
            return;
        }

        $GptHandler = new GptHandler();
        $systemPrompt = 'You are a Laravel PHP migration code generating assistant. Respond only in this JSON format: {file: "contents of migration file", filename: "migration_file_name_without_date", comments: "additional notes for user"}';
        $response = $GptHandler->generateCode($input, $systemPrompt);

        $response = json_decode($response);

        if (!$response) {
            $this->error('Error: OpenAI API response is not valid JSON. Try tweaking your prompt.');
            return;
        }

        if (!isset($response->file)) {
            $this->error('Error: OpenAI API response is missing the file property. Try tweaking your prompt.');
            return;
        }

        $filename = date('Y_m_d_His') . '_' . $response->filename ?? 'custom_ai_migration.php';

        $path = base_path("database/migrations/{$filename}.php");
        file_put_contents($path, $response->file);

        $info = "Migration file created: {$filename}.";

        if ($response->comments) {
            $info .= " {$response->comments}";
        }

        $this->info($info);
    }
}
