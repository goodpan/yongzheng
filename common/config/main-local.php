<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            //'dsn' => 'mysql:host=47.94.161.223;dbname=yongzheng',
            //'username' => 'root',
            //'password' => 'liu5555',
            'dsn' => 'mysql:host=127.0.0.1;dbname=yongzheng',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix'=>'yz_'
        ],
        'request' => [
            'cookieValidationKey' => 'fcuVvgFv0Vex88Qm5N2-h6HH5anM4HEd',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',
                'username' => 'suwen0603@163.com',//授权邮箱
                'password' => 'yongzheng2017',//授权码，在163邮箱中设置--POP3/SMTP/IMAP，打开服务设置授权码
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
    ],
];