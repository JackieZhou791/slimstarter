<?php

namespace Application\Backoffice\Controllers;

use Joyrun\BaseController;

class ExampleController extends BaseController
{

    //multiple db access example
    private function dbsample()
    {
        $c = $this->app->getContainer();

        $user = Adminuser::find(1);

        var_dump($user->toArray());

        $db = $c['db'];
        $rows = $db->getConnection('db1')->select('select * from users');
        var_dump($rows);
    }
}