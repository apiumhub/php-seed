<?php

require '../vendor/autoload.php';

use Monolog\Logger;
use resources\UserResource;

//$logWriter = new \Slim\LogWriter(fopen('../logs/errors_slim.log', 'a'));

$config = [
    'settings' => [
        'displayErrorDetails' => true,

        'logger' => [
            'name' => 'slim-app',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '../logs/errors_slim.log',
        ],
    ],
];
$app = new \Slim\App(
    $config
);

//error page with nginx or IIS

UserResource::get()->add($app);
$app->run();