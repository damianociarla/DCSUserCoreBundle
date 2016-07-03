<?php

namespace DCS\User\CoreBundle\Tests\Helper;

use DCS\User\CoreBundle\Helper\PasswordHelper;
use DCS\User\CoreBundle\Tests\TestUser;

class PasswordHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testEncodeUserPassword()
    {
        $user = new TestUser();

        $mockUserPasswordEncoder = $this->createMock('Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface');
        $mockUserPasswordEncoder->expects($this->any())
            ->method('encodePassword')
            ->with($this->equalTo($user), $this->equalTo('plain-password'))
            ->will($this->returnValue('encoded-password'));

        $passwordHelper = new PasswordHelper($mockUserPasswordEncoder);
        $password = $passwordHelper->encodeUserPassword($user, 'plain-password');

        $this->assertEquals('encoded-password', $password);
    }

    public function testUpdateUserPassword()
    {
        $user = new TestUser();
        $newPassword = 'new-plain-password';

        $mockUserPasswordEncoder = $this->createMock('Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface');
        $mockUserPasswordEncoder->expects($this->any())
            ->method('encodePassword')
            ->with($this->equalTo($user), $this->equalTo($newPassword))
            ->will($this->returnValue('new-encoded-password'));

        $passwordHelper = new PasswordHelper($mockUserPasswordEncoder);
        $passwordHelper->updateUserPassword($user, $newPassword);

        $this->assertEquals('new-encoded-password', $user->getPassword());
    }
}