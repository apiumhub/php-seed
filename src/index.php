<?php

require '../vendor/autoload.php';

use resources\UserResource;

$logWriter = new \Slim\LogWriter(fopen('../logs/errors_slim.log', 'a'));

$app = new \Slim\Slim(array(
    'log.enabled' => true,
    'log.level' =>      \Slim\Log::DEBUG,
    'mode' =>           'production',
    'log.writer' => $logWriter
));

//error page with nginx or IIS

UserResource::add($app);
$app->run();