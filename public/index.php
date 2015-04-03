<?php

$loader = require '../vendor/autoload.php';

use API\Common\Authentication\DataBaseAuthentication;
use Slim\Slim;

$app = new Slim();

$app->get('/', function(){
	echo 'Click here <a href="/hello/world">Hello world</a>';
});

$app->get('/hello/:name', function($name) {
	echo "Hello, $name";
});

$app->post('/authenticate',function() use ($app){
	
	$authEngine = new DataBaseAuthentication('sqlite');
	
	$app->response->setStatus($authEngine->authenticate($app->request->post('username'),$app->request->post('password')));
	
});


$app->run();