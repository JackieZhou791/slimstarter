<?php
namespace Application\Backoffice\Controllers;

use Illuminate\Pagination\Paginator;
use Joyrun\Controller\BackofficeController;
use Application\Backoffice\Model\Adminuser;

class UserController extends BackofficeController
{
    public function index()
    {
        //array(4) { ["_page"]=> string(1) "3" ["_perPage"]=> string(2) "30" ["_sortDir"]=> string(3) "ASC" ["_sortField"]=> string(2) "id" }
        $params = $this->get('request')->getParams();
        $fields = ['id', 'username', 'email', 'status', 'created_at', 'updated_at'];
        
        $db = $this->get('db');
            
        $totalCount = $db::table('adminusers')->count();
        
        $currentPage = !empty($params['_page']) ? $params['_page'] : '';
        if(!empty($currentPage)) {
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $alldata = $db::table('adminusers')->select($fields)
                    ->paginate(30)
                    ->toArray();
            $data = $alldata['data'];
        } else {
            
            $data = Adminuser::all($fields)->toArray();
        }

        
        foreach($data as $k => &$item) {
            $item = (array)$item;
            if($item['id'] == 1) {
                $data[$k]['id'] = '';
            }
        }
        return $this->get('response')->withHeader('X-Total-Count', $totalCount)->withJson($data);
    }

    public function create()
    {
        $params = [
            'username' => $this->get('request')->getParam('username'),
            'password' => password_hash($this->get('request')->getParam('password'), PASSWORD_DEFAULT),
            'email' => $this->get('request')->getParam('email'),
            'role' => $this->get('request')->getParam('role'),
            'status' => $this->get('request')->getParam('status'),
        ];
        
        $user = Adminuser::create($params);
        
        if(!$user->id) {
            $data = ['error'=> 1, 'message'=> 'User create failed'];
        }
        
        $data = [
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'role' => $user->role,
            'status' => $user->status,
        ];
        return $this->get('response')->withJson($data);
    }
    
    public function show()
    {
        $userid = $this->revApiValue();
        $user = Adminuser::find($userid);
        if(!$user->id) {
            $data = ['error'=> 1, 'message'=> 'User create failed'];
        } else {
            $data = [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'status' => $user->status,
            ];
        }
        return $this->get('response')->withJson($data);
    }
    
    public function update()
    {
        $userid = $this->revApiValue();
        
        $user = Adminuser::find($userid);
        
        if(!$user->id) {
            $data = ['error'=> 1, 'message'=> 'User create failed'];
        } else {
            
            $data = [
                'username' => $this->get('request')->getParam('username'),
                'email' => $this->get('request')->getParam('email'),
                'role' => $this->get('request')->getParam('role'),
                'status' => $this->get('request')->getParam('status'),
            ];
            $password = $this->get('request')->getParam('password');

            if(!empty($password)) {
                $data['password'] = password_hash($this->get('request')->getParam('password'), PASSWORD_DEFAULT);
            }

            $user->update($data);
        }
        
        return $this->get('response')->withJson($data);
    }
    
    public function delete()
    {
        $userid = $this->revApiValue();
        
        $user = Adminuser::find($userid);
        
        if($user->delete()) {
            $data = ['message'=> 'User deleted'];
        } else {
            $data = ['error'=> 1, 'message'=> 'User deleted failed'];
        }
        
        return $this->get('response')->withJson($data);
    }
}
