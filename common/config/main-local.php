<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yongzhengdb',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix'=>'yz_'
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
