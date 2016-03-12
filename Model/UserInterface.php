<?php

namespace DCS\User\CoreBundle\Model;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

interface UserInterface extends AdvancedUserInterface
{
    /**
     * Get id
     *
     * @return mixed
     */
    public function getId();

    /**
     * Sets id
     *
     * @param mixed $id
     * @return RoleInterface
     */
    public function setId($id);

    /**
     * Set username
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username);

    /**
     * Set password
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password);

    /**
     * Set enabled flag
     *
     * @param boolean $enabled
     * @return UserInterface
     */
    public function setEnabled($enabled);

    /**
     * Checks whether the user is locked
     *
     * @return boolean
     */
    public function isAccountLocked();

    /**
     * Sets locked status
     *
     * @param boolean $locked
     * @return UserInterface
     */
    public function setLocked($locked);

    /**
     * Checks whether the user is expired
     *
     * @return boolean
     */
    public function isAccountExpired();

    /**
     * Sets expired status
     *
     * @param boolean $expired
     * @return UserInterface
     */
    public function setExpired($expired);

    /**
     * Checks whether the user's credentials (password) has expired
     *
     * @return boolean
     */
    public function isCredentialsExpired();

    /**
     * Sets the credentials status
     *
     * @param boolean $credentialsExpired
     * @return UserInterface
     */
    public function setCredentialsExpired($credentialsExpired);
}