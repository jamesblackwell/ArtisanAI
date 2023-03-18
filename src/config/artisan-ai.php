<?php

return [
    // get this here: https://platform.openai.com/account/api-keys
    'openai_api_key' => env('OPENAI_API_KEY', ''),

    // strongly recommend you use gpt-4, though it will technically work with gpt-3.5-turbo
    'model' => env('OPENAI_MODEL', 'gpt-4'),

    'timeout' => env('OPENAI_TIMEOUT', 60),
];
