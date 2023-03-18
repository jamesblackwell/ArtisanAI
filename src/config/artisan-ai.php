<?php

return [
    'openai_api_key' => env('OPENAI_API_KEY', ''),
    'model' => env('OPENAI_MODEL', 'gpt-4'),
    'timeout' => env('OPENAI_TIMEOUT', 60),
];
