<?php

namespace Joyrun\Controller;

use MartynBiz\Slim3Controller\Controller;

class BaseController extends Controller
{
    public function __construct(\Slim\App $app)
    {
        parent::__construct($app);
    }
    
    public function haltonJson($data) 
    {
        header('Content-type: application/json');
        echo json_encode($data);
        die();
    }
}
