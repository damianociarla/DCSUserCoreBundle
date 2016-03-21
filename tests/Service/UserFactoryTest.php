<?php

namespace DCS\User\CoreBundle\Tests\Service;

use DCS\User\CoreBundle\Service\UserFactory;

class UserFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $userFactory = new UserFactory('DCS\User\CoreBundle\Tests\TestUser');
        $this->assertInstanceOf('DCS\User\CoreBundle\Model\UserInterface', $userFactory->create());
    }
}