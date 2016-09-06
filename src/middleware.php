<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

//$app->add(new \RKA\SessionMiddleware(['name' => 'slimstarter']));
//fixed session_start init later than request
$session = new \RKA\SessionMiddleware(['name' => 'slimstarter']);
$session->start();
