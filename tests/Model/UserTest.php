<?php

namespace DCS\User\CoreBundle\Tests\Model;

use DCS\User\CoreBundle\Model\UserInterface;
use DCS\User\CoreBundle\Tests\TestUser;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserInterface */
    private $user;

    public function setUp()
    {
        $this->user = new TestUser();
    }

    public function testConstructorDefaultData()
    {
        $this->assertTrue(is_string($this->user->getSalt()));

        $this->assertTrue($this->user->isEnabled());
        $this->assertFalse($this->user->isAccountLocked());
        $this->assertTrue($this->user->isAccountNonLocked());
        $this->assertFalse($this->user->isAccountExpired());
        $this->assertTrue($this->user->isAccountNonExpired());
        $this->assertFalse($this->user->isCredentialsExpired());
        $this->assertTrue($this->user->isCredentialsNonExpired());

        $this->assertTrue(is_array($this->user->getRoles()));
    }

    public function testId()
    {
        $this->user->setId(1);
        $this->assertEquals(1, $this->user->getId());
    }

    public function testUsername()
    {
        $this->user->setUsername('acme');
        $this->assertEquals('acme', $this->user->getUsername());
    }

    public function testPassword()
    {
        $this->user->setPassword('acme');
        $this->assertEquals('acme', $this->user->getPassword());
    }

    public function testEnabled()
    {
        $this->user->setEnabled(true);
        $this->assertTrue($this->user->isEnabled());
        $this->user->setEnabled(false);
        $this->assertFalse($this->user->isEnabled());
    }

    public function testAccountLocked()
    {
        $this->assertFalse($this->user->isAccountLocked());
        $this->assertTrue($this->user->isAccountNonLocked());

        $this->user->setLocked(true);

        $this->assertTrue($this->user->isAccountLocked());
        $this->assertFalse($this->user->isAccountNonLocked());
    }

    public function testAccountExpired()
    {
        $this->assertFalse($this->user->isAccountExpired());
        $this->assertTrue($this->user->isAccountNonExpired());

        $this->user->setExpired(true);

        $this->assertTrue($this->user->isAccountExpired());
        $this->assertFalse($this->user->isAccountNonExpired());
    }

    public function testCredentialsExpired()
    {
        $this->assertFalse($this->user->isCredentialsExpired());
        $this->assertTrue($this->user->isCredentialsNonExpired());

        $this->user->setCredentialsExpired(true);

        $this->assertTrue($this->user->isCredentialsExpired());
        $this->assertFalse($this->user->isCredentialsNonExpired());
    }

    public function testSerializeMethod()
    {
        $this->user->setUsername('acme');

        $serializedData = $this->user->serialize();
        $this->assertEquals('acme', unserialize($serializedData)[0]);

        $this->user->setUsername('johndoe');
        $this->assertEquals('johndoe', $this->user->getUsername());

        $this->user->unserialize($serializedData);
        $this->assertEquals('acme', $this->user->getUsername());
    }

    public function testIsEqualToMethod()
    {
        $this->user->setUsername('acme');

        $this->assertTrue($this->user->isEqualTo($this->user));

        $userToCompare = new TestUser();
        $userToCompare->setUsername('acme');

        $this->assertFalse($this->user->isEqualTo($userToCompare));
    }
}