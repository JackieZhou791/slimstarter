<?php
// Routes
$app->get('/', function(){
    echo 'Hello world!';
});

$app->group('/helloworld', function () use ($app) {

    $controller = new Application\Helloworld\Controllers\IndexController($app);

    $app->get('', $controller('index'));
    $app->get('/', $controller('index'));
    $app->get('/testsession', $controller('testsession'));
});

$app->group('/backoffice', function () use ($app) {

    $controller = new Application\Backoffice\Controllers\IndexController($app);

    $app->get('', $controller('index'))->setName('backoffice.index');
    $app->get('/login', $controller('login'))->setName('backoffice.login');
    $app->post('/loginPost', $controller('postLogin'))->setName('backoffice.postLogin');
    $app->get('/logout', $controller('logout'));
    
    $app->group('/users',  function() use ($app) {
        $controller = new Application\Backoffice\Controllers\UserController($app);

        $app->get('', $controller('index'));
        $app->get('/{id:[0-9]+}', $controller('show'));
        $app->get('/{id:[0-9]+}/edit', $controller('edit'));
        $app->put('/{id:[0-9]+}', $controller('put'));
        $app->delete('/{id:[0-9]+}', $controller('delete'));
    });
});
