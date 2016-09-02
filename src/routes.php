<?php
// Routes

$app->get('/[{name}]',  function() use ($app) {

    $controller = new Application\Helloworld\Controllers\IndexController($app);
    $controller->index();
});
