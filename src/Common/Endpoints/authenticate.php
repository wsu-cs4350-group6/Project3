<?php

use API\Common\Authentication\DataBaseAuthentication;
use API\Common\Authentication\Access;

$app->post('/authenticate',function() use ($app, $env){
    $access = new Access();
    $uuid = $app->request->headers['Authorization'];

    if(!$uuid)
    {
        $app->response->setStatus(401);
        $app->response->setBody('You must have an access key');
        return;
    }
    if(!$access->checkUUID($uuid, $env))
    {
        $app->response->setStatus(401);
        $app->response->setBody('You must have a valid access key');
        return;
    }
    if(!$app->request->params('username'))
    {
        $app->response->setStatus(401);
        $app->response->setBody('You must have a valid username parameter');
        return;
    }
    if(!$app->request->params('password'))
    {
        $app->response->setStatus(401);
        $app->response->setBody('You must have a valid password parameter');
        return;
    }

    $authEngine = new DataBaseAuthentication('sqlite', $env);

    $app->response->setStatus($authEngine->authenticate($app->request->post('username'),$app->request->post('password')));

});