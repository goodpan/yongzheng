<?php

$config = [
    'components' => [
        'request' => [
            'cookieValidationKey' => 'fcuVvgFv0Vex88Qm5N2-h6HH5anM4HEd',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=120.78.168.175;dbname=yongzheng',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
            'tablePrefix' => 'yz_'
        ],
        // 'db' => [
        //     'class' => 'yii\db\Connection',
        //     'dsn' => 'mysql:host=127.0.0.1;dbname=yongzheng',
        //     'username' => 'root',
        //     'password' => 'root',
        //     'charset' => 'utf8',
        //     'tablePrefix' =>'yz_',
        // ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs'=>['127.0.0.1']
    ];
}

return $config;
