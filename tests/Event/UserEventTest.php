<?php

namespace DCS\User\CoreBundle\Tests\Event;

use DCS\User\CoreBundle\Event\UserEvent;
use DCS\User\CoreBundle\Model\UserInterface;

class UserEventTest extends \PHPUnit_Framework_TestCase
{
    public function testMethodGetUser()
    {
        $user = $this->getMockBuilder(UserInterface::class)->getMock();
        $userEvent = new UserEvent($user);
        $this->assertInstanceOf(UserInterface::class, $userEvent->getUser());
    }
}