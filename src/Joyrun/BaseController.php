<?php

namespace Joyrun;

use MartynBiz\Slim3Controller\Controller;

class BaseController extends Controller
{
    public function __construct(\Slim\App $app)
    {
        parent::__construct($app);
        $this->request = $this->app->getContainer()->get('request');
        $this->response = $this->app->getContainer()->get('response');
    }

}