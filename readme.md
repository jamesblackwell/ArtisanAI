# ArtisanAI

WIP: This package is still in development but since it's only designed for use in your development environment, feel free to start using it!

ArtisanAI is a Laravel package that helps you scaffold your Laravel application by generating code files such as migrations, controllers, models, and tests using OpenAI's GPT-4. It saves a lot of copy and pasting back from your IDE and ChatGPT.

It allows you to do stuff like this:

```
php artisan ai:migration "add two columns to images table called file name and file size, drop the column called file path, and rename the column called file type to file extension"
```

Then the package will automatically add the migration to the correct folder in your Laravel application.

## Features

- Generate Laravel migration files with AI-powered code generation
- (Planned) Generate Laravel controllers, models, and tests
- Easy integration with Laravel applications
- Automatically saves generated code to the appropriate folders

## Installation

1. Install the package using Composer. It's recommended to install the package as a development dependency:

```
composer require --dev jamesblackwell/artisan-ai
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
