<?php
date_default_timezone_set('Asia/Tokyo');
mb_language('ja');
mb_internal_encoding('UTF-8');

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        //app info
        'appInfo' => [
            'name' => '伺御食 🦊⛩🦊',
            'author' => 'アルム＝バンド',
            'cpYear' => '2019'
        ],
        //img data
        'dataPath' => [
            __DIR__ . '/../public/img/storage/',
            '../img/storage/',
        ],
        //一覧除外リスト
        'excludes' => [
            '.',
            '..'
        ],
        'mealTimeZone' => [
            0,
            11,
            17
        ], //食事の時間帯の区切り方。要素数は3つ [0, 11, 17] ならば 朝:0～11, 昼:11～17, 夜:17~24

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'debug' => getenv('DEBUG'),
        // debug bar
        'debugbar' => [
            'storage' => [
                'enabled' => true,
                'path' => __DIR__. '/../logs/debug/',
            ],
        ],
        'displayErrorDetails' => getenv('DISPLAY_ERROR'), // set to false in production
    ],
];
