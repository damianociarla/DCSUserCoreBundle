<?php

namespace DCS\User\CoreBundle\Manager;

use DCS\User\CoreBundle\DCSUserCoreEvents;
use DCS\User\CoreBundle\Event\UserEvent;
use DCS\User\CoreBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Delete
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Delete user
     *
     * @see DCSUserCoreEvents::BEFORE_DELETE_USER
     * @see DCSUserCoreEvents::DELETE_USER
     * @see DCSUserCoreEvents::AFTER_DELETE_USER
     *
     * @param UserInterface $user
     */
    public function __invoke(UserInterface $user)
    {
        $event = new UserEvent($user);

        $this->dispatcher->dispatch(DCSUserCoreEvents::BEFORE_DELETE_USER, $event);
        $this->dispatcher->dispatch(DCSUserCoreEvents::DELETE_USER, $event);
        $this->dispatcher->dispatch(DCSUserCoreEvents::AFTER_DELETE_USER, $event);
    }
}