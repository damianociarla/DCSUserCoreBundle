<?php

namespace DCS\User\CoreBundle\Event;

use DCS\User\CoreBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\Event;

class UserEvent extends Event
{
    /**
     * @var UserInterface
     */
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}