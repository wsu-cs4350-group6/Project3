<?php

use Slim\Slim;

$autoLoader = realpath(
    __DIR__
    . DIRECTORY_SEPARATOR .'..'
    . DIRECTORY_SEPARATOR .'..'
    . DIRECTORY_SEPARATOR . 'vendor'
    . DIRECTORY_SEPARATOR . 'autoload.php'
);

require $autoLoader;

require 'config.php';

$app = new Slim(
    $config['app']['slim-config']
);


foreach($config['app']['endpoints'] as $endpoint)
{
    require $endpoint;
}

$app->run();