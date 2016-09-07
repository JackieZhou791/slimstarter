<?php

namespace Joyrun\Controller;

class BackofficeController extends BaseController
{
    public function __construct(\Slim\App $app)
    {
        parent::__construct($app);
    }
    
    public function init() 
    {
        $data = [
            'error' => 0,
            'emssage' => 'Not authorized.'
        ];
        $session = $this->get('session');
        if(!$session->get('admin_id')) {
            return $this->haltonJson($data);
        }
    }
    
    public function revApiValue() 
    {
        
        $baseUri = $this->get('request')->getRequestTarget();
        preg_match('/[0-9]*$/',$baseUri, $matches);
        if(!empty($matches[0])) {
            return $matches[0]; 
        }
    }
}
