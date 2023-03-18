# ArtisanAI

ArtisanAI is a Laravel package that helps you scaffold your Laravel application by generating code files such as migrations, controllers, models, and tests using OpenAI's GPT-4 API. The package provides a set of easy-to-use Artisan commands that allow you to create these files with the help of AI-generated code.

This package was written almost entirely by GPT-4.

## Features

- Generate Laravel migration files with AI-powered code generation
- (Planned) Generate Laravel controllers, models, and tests
- Easy integration with Laravel applications
- Automatically saves generated code to the appropriate folders

## Requirements

- Laravel 6.x, 7.x, or 8.x
- PHP 7.2 or higher
- OpenAI API key

## Installation

1. Install the package using Composer:

```
composer require jamesblackwell/artisan-ai
```

2. Publish the configuration file by running:

```
php artisan vendor:publish --provider="JamesBlackwell\ArtisanAI\ArtisanAIServiceProvider" --tag="config"
```

3. Add your OpenAI API key to your `.env` file:

```
OPENAI_API_KEY=your_openai_api_key
```

## Usage

Currently, the package supports generating migration files. To create a migration file, use the following command:

```
php artisan ai:migration "create migration to add two columns to images table called file name and file size"

```

Replace the text inside the quotes with your desired instructions. The package will use GPT-4 API to generate the code for the migration and save it to the correct folder in your Laravel application.

## Planned Features

- Generate controllers, models, and tests using AI-powered code generation
- Further customization and configuration options

## Contributing

Contributions, issues, and feature requests are welcome! Feel free to open an issue or submit a pull request on the [GitHub repository](https://github.com/jamesblackwell/ArtisanAI).

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
