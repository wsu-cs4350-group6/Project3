<?php

$loader = require '../vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function(){
	echo 'Click here <a href="/hello/world">Hello world</a>';
});

$app->get('/hello/:name', function($name) {
	echo "Hello, $name";
});

$app->run();