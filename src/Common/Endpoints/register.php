<?php

use API\Model\User;

$app->post('/register',function() use($app){
    $user = new User($app->request->post('username'),$app->request->post('password'));
    $app->response->setStatus(501);
    if($user->save())
    {
        $app->response->setStatus(200);
    }
});