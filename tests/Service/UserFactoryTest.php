<?php

namespace DCS\User\CoreBundle\Tests\Service;

use DCS\User\CoreBundle\DCSUserCoreEvents;
use DCS\User\CoreBundle\Event\UserEvent;
use DCS\User\CoreBundle\Model\UserInterface;
use DCS\User\CoreBundle\Service\UserFactory;
use DCS\User\CoreBundle\Tests\TestUser;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UserFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $dispatcher = $this->getMockBuilder(EventDispatcherInterface::class)->getMock();
        $dispatcher
            ->expects($this->once())
            ->method('dispatch')
            ->with(DCSUserCoreEvents::USER_CREATED, $this->isInstanceOf(UserEvent::class));

        $userFactory = new UserFactory(TestUser::class, $dispatcher);
        $this->assertInstanceOf(UserInterface::class, $userFactory->create());
    }
}