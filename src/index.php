<?php

require '../vendor/autoload.php';

use Monolog\Logger;
use resources\UserResource;

//$logWriter = new \Slim\LogWriter(fopen('../logs/errors_slim.log', 'a'));

$config = [
    'settings' => [
        'displayErrorDetails' => true,

        'logger' => [
            'name' => "dexeus",
            'level' => Monolog\Logger::DEBUG,
            'path'  => __DIR__ . '/../logs/errors_slim.log',
        ],
    ],
];
$app = new \Slim\App(
    $config
);

$c = $app->getContainer();
$c['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $formatter = new Monolog\Formatter\LineFormatter(null, null, true, false);
    $stdOutHandler=new Monolog\Handler\StreamHandler('php://stdout', Monolog\Logger::DEBUG);
    $stdOutHandler->setFormatter($formatter);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));
    $logger->pushHandler($stdOutHandler);
    return $logger;
};
$c['errorHandler'] = function ($c) use ($app)  {
    return function ($_, $_, \Exception $exception) use ($c, $app) {
        $c['logger']->error("Message: [".$exception->getMessage()."]\n".$exception->getTraceAsString());
        return $c['response']->withStatus(500)
            ->withHeader('Content-Type', 'application/json')
            ->write("{\"text\":\"Something went wrong!\",\"code\":-1}");
    };
};

UserResource::get()->add($app);
$app->run();