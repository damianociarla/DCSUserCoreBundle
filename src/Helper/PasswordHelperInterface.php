<?php

namespace DCS\User\CoreBundle\Helper;

use DCS\User\CoreBundle\Model\UserInterface;

interface PasswordHelperInterface
{
    /**
     * Get password encoded
     *
     * @param UserInterface $user
     * @param string $password
     * @return string
     */
    public function encodeUserPassword(UserInterface $user, $password);

    /**
     * Update user password
     *
     * @param UserInterface $user
     * @param string $password
     */
    public function updateUserPassword(UserInterface $user, $password);
}