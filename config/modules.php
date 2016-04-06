<?php
return new \Phalcon\Config([
    'welcome' => [
        'className' => 'Dc\Welcome\Module',
        'path' => __DIR__ . '/../apps/welcome/Module.php'
    ],

    'wechat' => [
        'className' => 'Dc\Wechat\Module',
        'path' => __DIR__ . '/../apps/wechat/Module.php'
    ]
]);