<?php

$config = [ 'components' => [
    'request' => [
        'cookieValidationKey' => 'fcuVvgFv0Vex88Qm5N2-h6HH5anM4HEd',
    ],
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=47.94.161.223;dbname=yongzheng',
        'username' => 'root',
        'password' => 'study123456',
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
            'username' => 'suwen0603@163.com',//��Ȩ����
            'password' => 'yongzheng2017',//��Ȩ�룬��163����������--POP3/SMTP/IMAP���򿪷���������Ȩ��
            'port' => '465',
            'encryption' => 'ssl',
        ],
    ],
],
];
if (!YII_ENV_TEST) {  // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [  'class' => 'yii\debug\Module', 'allowedIPs' => [ '*'] ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [ 'class' => 'yii\gii\Module', ]; }
return $config;