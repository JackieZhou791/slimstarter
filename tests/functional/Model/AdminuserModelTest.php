<?php

namespace Tests\Functional\Model;

use Tests\Functional\BaseModelTestCase;
use Application\Backoffice\Model\Adminuser;

class AdminuserModelTest extends BaseModelTestCase
{
    public function testCreateAdminuser()
    {
        $this->initApp();

        $adminuser = new Adminuser;
        $adminuser->username = 'jackie';
        $adminuser->email = 'jackie@jackie.com';
        $adminuser->password = password_hash('password', PASSWORD_DEFAULT);
        $adminuser->role = 'admin';
        $adminuser->status = 1;
        $adminuser->save();

        $adminuserObj = $adminuser->find($adminuser->id);
        $this->assertEquals('jackie', $adminuserObj->username);
        if($adminuserObj->id > 0) {
            $adminuserObj->delete();
        }
    }
}