<?php

use API\Common\Authentication\Access;

$app->get('/access', function() use ($app, $env) {

    $access = new Access();
    $uuid5 = $access->getUUID($env['REMOTE_ADDR']);
    $access->storeUUID($env['REMOTE_ADDR'], $uuid5, $env);
    $access->buildUUIDResponse($app, $uuid5);

});

