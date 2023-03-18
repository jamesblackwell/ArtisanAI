<?php

namespace JamesBlackwell\ArtisanAI;

use JamesBlackwell\ArtisanAI\Console\GenerateMigrationCommand;
use Illuminate\Support\ServiceProvider;

class ArtisanAIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/artisan-ai.php' => config_path('artisan-ai.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/artisan-ai.php',
            'artisan-ai'
        );

        $this->commands([
            GenerateMigrationCommand::class,
        ]);
    }
}
