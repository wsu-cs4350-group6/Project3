<?php

use API\Common\Authentication\DataBaseAuthentication;

$app->post('/authenticate',function() use ($app){

    $authEngine = new DataBaseAuthentication('sqlite');

    $app->response->setStatus($authEngine->authenticate($app->request->post('username'),$app->request->post('password')));

});