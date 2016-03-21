<?php

namespace DCS\User\CoreBundle\Repository;

use DCS\User\CoreBundle\Model\UserInterface;

interface UserRepositoryInterface
{
    /**
     * Find User object by id.
     *
     * @param mixed $id
     * @return UserInterface|null
     */
    public function findOneById($id);

    /**
     * Find User object by username.
     *
     * @param string $username
     * @return UserInterface|null
     */
    public function findOneByUsername($username);
}