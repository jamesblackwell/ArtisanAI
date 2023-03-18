<?php

namespace JamesBlackwell\ArtisanAI\Console;

use Illuminate\Console\Command;
use JamesBlackwell\ArtisanAI\OpenAI\Gpt4Handler;


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

        $gpt4Handler = new Gpt4Handler();
        $migrationCode = $gpt4Handler->generateCode($input, 'Write only Laravel PHP code. Generate a migration file. Return only code, no text');

        preg_match('/\bcreate_(.+)_table\b/', $migrationCode, $matches);

        if (!empty($matches) && isset($matches[1])) {
            $filename = date('Y_m_d_His') . "_create_{$matches[1]}_table.php";
        } else {
            $filename = date('Y_m_d_His') . '_ai_migration.php';
        }

        $path = base_path("database/migrations/{$filename}");
        file_put_contents($path, $migrationCode);

        $this->info("Migration file created: {$filename}");
    }
}
