<?php
namespace Application\Helloworld\Controllers;

use MartynBiz\Slim3Controller\Controller;

class IndexController extends Controller
{
    public function index() 
    {
        $c = $this->app->getContainer();
        echo $c->renderer->render('helloworld/index.html');
    }
}

