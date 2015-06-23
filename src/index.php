<?php

require '../vendor/autoload.php';

use resources\UserResource;

$app = new \Slim\Slim();
UserResource::add($app);
$app->run();