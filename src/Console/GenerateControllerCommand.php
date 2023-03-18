<?php

namespace JamesBlackwell\ArtisanAI\Console;

use Illuminate\Console\Command;
use JamesBlackwell\ArtisanAI\OpenAI\GptHandler;

class GenerateControllerCommand extends Command
{
    protected $signature = 'ai:controller {name} {--resource}';

    protected $description = 'Generate controller file using OpenAI GPT-4 API';

    public function handle()
    {
        $name = $this->argument('name');
        $isResource = $this->option('resource');

        $apiKey = config('artisan-ai.openai_api_key');

        if (!$apiKey) {
            $this->error('Please set your OPENAI_API_KEY in the .env file.');
            return;
        }

        $GptHandler = new GptHandler();
        $systemPrompt = $isResource
            ? 'Write only Laravel PHP code. Generate a resource controller.'
            : 'Write only Laravel PHP code. Generate a controller.';
        $controllerCode = $GptHandler->generateCode("Create a controller named {$name}", $systemPrompt);

        $filename = "{$name}Controller.php";
        $path = app_path("Http/Controllers/{$filename}");
        file_put_contents($path, $controllerCode);

        $this->info("Controller file created: {$filename}");
    }
}
