<?php

namespace DCS\User\CoreBundle\Tests\Manager;

use DCS\User\CoreBundle\DCSUserCoreEvents;
use DCS\User\CoreBundle\Manager\Delete;
use DCS\User\CoreBundle\Tests\TestUser;

class DeleteTest extends \PHPUnit_Framework_TestCase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $dispatcher;
    /** @var Delete */
    protected $delete;

    public function setUp()
    {
        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->delete = new Delete($this->dispatcher);
    }

    public function testDelete()
    {
        $this->dispatcher->expects($this->exactly(3))->method('dispatch');
        $this->dispatcher->expects($this->at(0))->method('dispatch')->with(DCSUserCoreEvents::BEFORE_DELETE_USER);
        $this->dispatcher->expects($this->at(1))->method('dispatch')->with(DCSUserCoreEvents::DELETE_USER);
        $this->dispatcher->expects($this->at(2))->method('dispatch')->with(DCSUserCoreEvents::AFTER_DELETE_USER);

        call_user_func($this->delete, new TestUser());
    }
}