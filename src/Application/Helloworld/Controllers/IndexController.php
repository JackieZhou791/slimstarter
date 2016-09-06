<?php
namespace Application\Helloworld\Controllers;

use Joyrun\Controller\BaseController;
use Application\Backoffice\Model\Adminuser;

class IndexController extends BaseController
{

    public function index()
    {
        $c = $this->app->getContainer();
        $c['session']->set('name', 'jackie');
        return $this->render('helloworld/index.html');
    }

    public function testsession()
    {

        $c = $this->app->getContainer();
        echo $c['session']->get('name');
    }

    //multiple db access example
    private function dbsample()
    {
        $c = $this->app->getContainer();

        $user = Adminuser::find(1);

        var_dump($user->toArray());

        $db = $c['db'];
        $rows = $db->getConnection('crew')->select('select * from users');
        var_dump($rows);
    }
}
