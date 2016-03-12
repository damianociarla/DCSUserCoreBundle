<?php

namespace DCS\User\CoreBundle\Service;

use DCS\User\CoreBundle\Model\UserInterface;

interface UserFactoryInterface
{
    /**
     * Create e new empty instance of User
     *
     * @return UserInterface
     */
    public function create();
}