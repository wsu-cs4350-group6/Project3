<?php

$projectDir = realpath(dirname(__FILE__)
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR);
$srcDir = $projectDir . DIRECTORY_SEPARATOR . 'src';
$commonDir = $srcDir . DIRECTORY_SEPARATOR . 'Common';
$authDir = $commonDir . DIRECTORY_SEPARATOR . 'Authentication';
$endpoints = $commonDir . DIRECTORY_SEPARATOR . 'Endpoints';
$configDir = $srcDir . DIRECTORY_SEPARATOR . 'Config';
$viewsDir = $srcDir . DIRECTORY_SEPARATOR . 'Views';
$dataDir = $projectDir . DIRECTORY_SEPARATOR . 'data';

$config = [
    'app' => [
        'slim-config' => [
            'debug'       => true,
            'mode'        => 'development',
            'log.enabled' => true,
        ],
        'yii-config' => [

        ],
        'dir'          => [
            'authentication' => $authDir,
            'common'         => $commonDir,
            'config'         => $configDir,
            'src'            => $srcDir,
            'views'          => $viewsDir
        ],
        'endpoints' => [
            '/'             => $endpoints . DIRECTORY_SEPARATOR . 'home.php',
            '/access'       => $endpoints . DIRECTORY_SEPARATOR . 'access.php',
            '/authenticate' => $endpoints . DIRECTORY_SEPARATOR . 'authenticate.php',
            '/register'     => $endpoints . DIRECTORY_SEPARATOR . 'register.php'
        ],
        'database'  => [
            'sqliteFile'    => $dataDir . DIRECTORY_SEPARATOR . 'cs4350.sqlite',
            'host'          => 'localhost',
            'dbuser'        => 'cs4350',
            'dbpass'        => 'cs4350'
        ]
    ]
];