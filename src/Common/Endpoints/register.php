<?php

use API\Model\User;

$app->post('/register',function() use($app){
    $username = $app->request->post('username');
    $password = $app->request->post('password');
    
    $user = new User($username,$password);
    
    $app->response->setStatus(401);
    $app->response->setBody(json_encode(array('UsernameExists'=>'Please use another username')));
    
    if($user->save())
    {
        $user_row = User::exists($username);
        $app->response->setStatus(201);
        $app->response->setBody(json_encode(array('Location'=>'/user/'.$user_row['id']),JSON_UNESCAPED_SLASHES));
    }
    
    
});