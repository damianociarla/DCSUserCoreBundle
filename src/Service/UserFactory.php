<?php

namespace DCS\User\CoreBundle\Service;

use DCS\User\CoreBundle\DCSUserCoreEvents;
use DCS\User\CoreBundle\Event\UserEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UserFactory implements UserFactoryInterface
{
    /**
     * @var string
     */
    private $className;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct($className, EventDispatcherInterface $dispatcher)
    {
        $this->className = $className;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @inheritdoc
     */
    public function create()
    {
        $user = (new $this->className());

        $this->dispatcher->dispatch(DCSUserCoreEvents::USER_CREATED, new UserEvent($user));

        return $user;
    }
}