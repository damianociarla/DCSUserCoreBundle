<?php

namespace DCS\User\CoreBundle\Tests;

use DCS\User\CoreBundle\Model\User;

class TestUser extends User
{
    protected function initRoles()
    {
        $this->roles = [];
    }
}