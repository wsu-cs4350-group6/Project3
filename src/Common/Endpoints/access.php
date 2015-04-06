<?php

use API\Common\Authentication\SQLiteAccess;

$app->get('/access', function() use ($app, $env) {

    $access = new SQLiteAccess();
    $uuid5 = $access->getUUID($env['REMOTE_ADDR']);
    $access->storeUUID($env['REMOTE_ADDR'], $uuid5, $env);
    $access->buildUUIDResponse($app, $uuid5);

});

