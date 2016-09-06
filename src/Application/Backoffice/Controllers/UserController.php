<?php
namespace Application\Backoffice\Controllers;

use Joyrun\Controller\BackofficeController;
use Application\Backoffice\Model\Adminuser;

class UserController extends BackofficeController
{
    public function index()
    {
        $fields = ['username', 'email', 'status', 'created_at', 'updated_at'];
        $data = Adminuser::all($fields)->toArray();

        return $this->get('response')->withJson($data);
    }

    public function create()
    {
        
    }
    
    public function update()
    {
        
    }
    
    public function delete()
    {
        
    }
}
