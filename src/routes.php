<?php
// Routes
$app->group('/helloworld', function () use ($app) {

    $controller = new Application\Helloworld\Controllers\IndexController($app);

    $app->get('', $controller('index'));
    $app->get('/testsession', $controller('testsession'));
//    $app->post('', $controller('post'));
//    $app->get('/{id:[0-9]+}', $controller('show'));
//    $app->get('/{id:[0-9]+}/edit', $controller('edit'));
//    $app->put('/{id:[0-9]+}', $controller('put'));
//    $app->delete('/{id:[0-9]+}', $controller('delete'));
});