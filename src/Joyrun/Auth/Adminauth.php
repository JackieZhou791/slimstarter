<?php

namespace Joyrun\Auth;

use Application\Backoffice\Model\Adminuser;

class Adminauth
{
    protected $container = null;
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function attempt($identifier, $password)
    {
        echo $identifier;
        $user = Adminuser::where('username', $identifier)->first();

        if(!$user->id) {
            return false;
        }

        if(password_verify($password, $user->password)) {
            $this->container['session']->set('admin_id', $user->id);
            $this->container['session']->set('admin_name', $user->username);

            return true;
        }

        return false;
    }
}
