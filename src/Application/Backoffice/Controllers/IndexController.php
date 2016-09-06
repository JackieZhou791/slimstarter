<?php
namespace Application\Backoffice\Controllers;

use Joyrun\Controller\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        $session = $this->get('session');

        if(!$session->get('admin_id')) {
            return $this->get('response')->withRedirect($this->get('router')->pathFor('backoffice.login'));
        }

        $data['username'] = $session->get('admin_name');
        
        return $this->render('backoffice/index.html', $data );
    }

    public function login()
    {
        $session = $this->get('session');
        if($session->get('admin_id')) {
            return $this->get('response')->withRedirect($this->get('router')->pathFor('backoffice.index'));
        }
        $messages = $this->get('flash')->getMessages();

        $data = ['messages' => $messages];

        $c = $this->app->getContainer();
        return $this->render('backoffice/login.html', $data);
    }

    public function postLogin()
    {
        $auth = $this->get('adminauth')->attempt(
            $this->request->getParam('username'),
            $this->request->getParam('password')
        );

        if(!$auth) {
            $this->get('flash')->addMessage('note', '用户名或密码不正确');
            return $this->get('response')->withRedirect($this->get('router')->pathFor('backoffice.login'));
        }

        return $this->get('response')->withRedirect($this->get('router')->pathFor('backoffice.index'));
    }

    public function logout()
    {
        $session = $this->get('session');
        $session->destroy();
        
        return $this->get('response')->withRedirect($this->get('router')->pathFor('backoffice.login'));
    }
}
