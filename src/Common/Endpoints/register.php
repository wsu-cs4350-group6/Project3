<?php

$app->post('/register',function() use($app){
    var_dump(md5(time()));
});