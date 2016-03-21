<?php

namespace DCS\User\CoreBundle\Manager;

use DCS\User\CoreBundle\DCSUserCoreEvents;
use DCS\User\CoreBundle\Event\UserEvent;
use DCS\User\CoreBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Save
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
     * Save user
     *
     * @see DCSUserCoreEvents::BEFORE_SAVE_USER
     * @see DCSUserCoreEvents::SAVE_USER
     * @see DCSUserCoreEvents::AFTER_SAVE_USER
     *
     * @param UserInterface $user
     */
    public function __invoke(UserInterface $user)
    {
        $event = new UserEvent($user);

        $this->dispatcher->dispatch(DCSUserCoreEvents::BEFORE_SAVE_USER, $event);
        $this->dispatcher->dispatch(DCSUserCoreEvents::SAVE_USER, $event);
        $this->dispatcher->dispatch(DCSUserCoreEvents::AFTER_SAVE_USER, $event);
    }
}