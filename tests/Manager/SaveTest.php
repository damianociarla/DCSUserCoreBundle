<?php

namespace DCS\User\CoreBundle\Tests\Manager;

use DCS\User\CoreBundle\DCSUserCoreEvents;
use DCS\User\CoreBundle\Event\UserEvent;
use DCS\User\CoreBundle\Manager\Save;
use DCS\User\CoreBundle\Tests\TestUser;

class SaveTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $dispatcher;
    /** @var Save */
    protected $save;

    public function setUp()
    {
        $this->dispatcher = $this->createMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->save = new Save($this->dispatcher);
    }

    public function testSave()
    {
        $this->dispatcher->expects($this->exactly(3))->method('dispatch');
        $this->dispatcher->expects($this->at(0))->method('dispatch')->with(DCSUserCoreEvents::BEFORE_SAVE_USER, $this->isInstanceOf(UserEvent::class));
        $this->dispatcher->expects($this->at(1))->method('dispatch')->with(DCSUserCoreEvents::SAVE_USER, $this->isInstanceOf(UserEvent::class));
        $this->dispatcher->expects($this->at(2))->method('dispatch')->with(DCSUserCoreEvents::AFTER_SAVE_USER, $this->isInstanceOf(UserEvent::class));

        $this->save->__invoke(new TestUser());
    }
}