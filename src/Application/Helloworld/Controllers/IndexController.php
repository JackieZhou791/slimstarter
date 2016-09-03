<?php
namespace Application\Helloworld\Controllers;

use Joyrun\BaseController;

class IndexController extends BaseController
{

    public function index()
    {
        $c = $this->app->getContainer();
        $c['session']->set('name', 'jackie');
        $this->render('helloworld/index.html');
        return $this->response;
    }

    public function testsession()
    {

        $c = $this->app->getContainer();
        echo $c['session']->get('name');
    }
}
