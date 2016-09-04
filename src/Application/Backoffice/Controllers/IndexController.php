<?php
namespace Application\Backoffice\Controllers;

use Joyrun\BaseController;
use Application\Backoffice\Model\Adminuser;

class IndexController extends BaseController
{

    public function index()
    {

        $c = $this->app->getContainer();
        $session = $c['session'];

        if(!$session->get('admin_id')) {
            return $this->response->withRedirect($c['router']->pathFor('backoffice.login'));
        }

        $this->render('backoffice/index.html');
        return $this->response;
    }

    public function login()
    {
        $c = $this->app->getContainer();

        $session = $c['session'];

        if($session->get('admin_id')) {
            return $this->response->withRedirect($c['router']->pathFor('backoffice.index'));
        }
        $messages = $c['flash']->getMessages();

        $data = ['messages' => $messages];

        $c = $this->app->getContainer();
        $this->render('backoffice/login.html', $data);
        return $this->response;
    }

    public function postLogin()
    {
        $c = $this->app->getContainer();

        $auth = $c['adminauth']->attempt(
            $this->request->getParam('username'),
            $this->request->getParam('password')
        );

        if(!$auth) {
            $c['flash']->addMessage('note', '用户名或密码不正确');
            return $this->response->withRedirect($c['router']->pathFor('backoffice.login'));
        }

        return $this->response->withRedirect($c['router']->pathFor('backoffice.index'));
    }

}
