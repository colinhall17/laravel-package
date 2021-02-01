<?php

return [
    'routes' => [
        'web_prefix' => 'skeleton',
        'web_middleware' => ['web'],
        'api_prefix' => 'skeleton/api',
        'web_middleware' => ['api'],
    ]
];
