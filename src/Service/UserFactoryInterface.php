<?php

namespace DCS\User\CoreBundle\Service;

use DCS\User\CoreBundle\Model\UserInterface;

interface UserFactoryInterface
{
    /**
     * Create e new empty instance of User
     *
     * @see DCS\User\CoreBundle\DCSUserCoreEvents::USER_CREATED
     * 
     * @return UserInterface
     */
    public function create();
}