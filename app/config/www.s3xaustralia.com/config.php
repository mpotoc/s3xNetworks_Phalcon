<?php

defined('APP_PATH') || define('APP_PATH', realpath('.'));

return new \Phalcon\Config(array(
    'database' => array(
        'adapter'     => 'Mysql',
        'host'        => 'localhost',
        'username'    => 'root',
        'password'    => 'admin01',
        'dbname'      => 'escort_adverts',
        'charset'     => 'utf8',
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/app/controllers/',
        'modelsDir'      => APP_PATH . '/app/models/',
        'formsDir'       => APP_PATH . '/app/forms/',
        'migrationsDir'  => APP_PATH . '/app/migrations/',
        'viewsDir'       => APP_PATH . '/app/views/',
        'pluginsDir'     => APP_PATH . '/app/plugins/',
        'libraryDir'     => APP_PATH . '/app/library/',
        'cacheDir'       => APP_PATH . '/app/cache/',
        'logsDir'        => APP_PATH . '/app/logs/',
        'baseCountry'    => 'AU',
        'workingCountry' => 'Australia',
        'indexCountry'   => 'Australia',
        'mainLogo'       => 's3xaustralia',
        'mainTitle'      => 's3xAustralia - Escort Directory no.1 in Australia',
        'baseUri'        => 'http://'.$_SERVER['SERVER_NAME'].'/',
        'publicUrl'      => $_SERVER['SERVER_NAME'],
        'cryptSalt'      => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D',
        'liqpay_private' => 'vdXqcTnldtn4bnz67Z2covU7tWQgovJAfNHfh10l',
        'liqpay_public'  => 'i15035619760'
    ),
    'mail' => array(
        'fromName' => 's3xnetworks.com',
        'fromEmail' => 'no-reply@s3xnetworks.com',
        'smtp' => array(
            'server' => 'mail.s3xnetworks.com',
            'port' => 587,
            'security' => 'tls',
            'username' => 'no-reply@s3xnetworks.com',
            'password' => 'Adm1N001MaHaCf0r3V3r'
        )
    ),
    'amazon' => array(
        'AWSAccessKeyId' => '',
        'AWSSecretKey' => ''
    )
));