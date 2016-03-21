<?php

namespace DCS\User\CoreBundle\Helper;

use DCS\User\CoreBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordHelper implements PasswordHelperInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * PasswordHelper constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @inheritdoc
     */
    public function encodeUserPassword(UserInterface $user, $password)
    {
        return $this->passwordEncoder->encodePassword($user, $password);
    }

    /**
     * @inheritdoc
     */
    public function updateUserPassword(UserInterface $user, $password)
    {
        $user->setPassword($this->encodeUserPassword($user, $password));
    }
}