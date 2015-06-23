<?php

require '../vendor/autoload.php';
require "../vendor/slim/slim/Slim/Slim.php";
\Slim\Slim::registerAutoloader();
use resources\UserResource;
$app = new \Slim\Slim();
UserResource::add($app);
$app->run();