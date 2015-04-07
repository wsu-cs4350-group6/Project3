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

$app->get('/register',function() use($app){
    $body = <<<HTML
    <!DOCTYPE html>
    <html>
    <body>
        <title>Register</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/style.css" type="text/css" media="all">
    </body>
    <body>
        <div id='registration'>
            <h2>Registration</h2>
            <form action='/register' method='post'>
                <input type='text' name='username'/>
                <input type='password' name='password'/>
                <button type='submit'>Submit</button>
            </form>
        </div>
    </body>
    </html>
HTML;
    $app->response->setBody($body);
});