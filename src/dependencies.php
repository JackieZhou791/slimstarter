<?php
// DIC configuration

use Illuminate\Database\Capsule\Manager as Capsule;

$container = $app->getContainer();
// view renderer
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig($c->get('settings')['view']['template_path'], [
        'cache' => $c->get('settings')['view']['twig']['cache']
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//session
$container['session'] = function ($c) {
    $session = new \RKA\Session();
    return $session;
};


$capsule = new Capsule;
$capsule->addConnection($container->get('settings')['database']['default'], 'default');
$capsule->addConnection($container->get('settings')['database']['db1'], 'db1');

$capsule->bootEloquent();
$capsule->setAsGlobal();
