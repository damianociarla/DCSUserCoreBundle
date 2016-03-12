<?php

namespace DCS\User\CoreBundle\Model;

use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface as CoreUserInterface;

abstract class User implements UserInterface, EquatableInterface, \Serializable
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $salt;

    /**
     * @var string
     */
    protected $password;

    /**
     * The implementation is left to choose arbitrarily
     *
     * @var mixed
     */
    protected $roles;

    /**
     * @var boolean
     */
    protected $enabled;

    /**
     * @var boolean
     */
    protected $locked;

    /**
     * @var boolean
     */
    protected $expired;

    /**
     * @var boolean
     */
    protected $credentialsExpired;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);

        $this->enabled = true;
        $this->locked = false;
        $this->expired = false;
        $this->credentialsExpired = false;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritdoc
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritdoc
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @inheritdoc
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Sets the initial roles value
     *
     * @return void
     */
    abstract protected function initRoles();

    /**
     * @inheritdoc
     */
    public function eraseCredentials() { /* No action. Overwrite if necessary */ }

    /**
     * @inheritdoc
     */
    public function isAccountLocked()
    {
        return $this->locked;
    }

    /**
     * @inheritdoc
     */
    public function isAccountNonLocked()
    {
        return !$this->locked;
    }

    /**
     * @inheritdoc
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isAccountExpired()
    {
        return $this->expired;
    }

    /**
     * @inheritdoc
     */
    public function isAccountNonExpired()
    {
        return !$this->expired;
    }

    /**
     * @inheritdoc
     */
    public function setExpired($expired)
    {
        $this->expired = $expired;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isCredentialsExpired()
    {
        return $this->credentialsExpired;
    }

    /**
     * @inheritdoc
     */
    public function isCredentialsNonExpired()
    {
        return !$this->credentialsExpired;
    }

    /**
     * @inheritdoc
     */
    public function setCredentialsExpired($credentialsExpired)
    {
        $this->credentialsExpired = $credentialsExpired;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function serialize()
    {
        return serialize([
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->username,
            $this->expired,
            $this->locked,
            $this->credentialsExpired,
            $this->enabled,
        ) = $data;
    }

    /**
     * @inheritdoc
     */
    public function isEqualTo(CoreUserInterface $user)
    {
        return !(
            $user->getUsername() !== $this->getUsername()
            || $user->getSalt() !== $this->getSalt()
            || $user->isAccountExpired() !== $this->isAccountExpired()
            || $user->isAccountLocked() !== $this->isAccountExpired()
            || $user->isCredentialsExpired() !== $this->isCredentialsExpired()
            || $user->isEnabled() !== $this->isEnabled()
        );
    }
}