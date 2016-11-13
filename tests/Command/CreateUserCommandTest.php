<?php

namespace DCS\User\CoreBundle\Tests\DependencyInjection\Command;

use DCS\User\CoreBundle\Command\CreateUserCommand;
use DCS\User\CoreBundle\Helper\PasswordHelperInterface;
use DCS\User\CoreBundle\Manager\Save;
use DCS\User\CoreBundle\Model\UserInterface;
use DCS\User\CoreBundle\Service\UserFactoryInterface;
use DCS\User\CoreBundle\Tests\TestUser;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\DependencyInjection\Container;

class CreateUserCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigureMethod()
    {
        $container = new Container();

        $command = new CreateUserCommand();
        $command->setContainer($container);

        $this->assertEquals('dcs_user:core:create_user', $command->getName());

        $this->assertTrue($command->getDefinition()->hasOption('username'));
        $this->assertTrue($command->getDefinition()->hasOption('password'));

        $this->assertTrue($command->getDefinition()->getOption('username')->isValueRequired());
        $this->assertTrue($command->getDefinition()->getOption('password')->isValueRequired());
    }

    public function testExecuteMethod()
    {
        $input = new ArrayInput([
            '--username' => 'acme',
            '--password' => '123'
        ]);

        $output = new NullOutput();

        $userFactory = $this->getMockBuilder(UserFactoryInterface::class)->getMock();
        $userFactory->expects($this->once())->method('create')->willReturn(new TestUser());

        $passwordHelper = $this->getMockBuilder(PasswordHelperInterface::class)->getMock();
        $passwordHelper->expects($this->once())->method('updateUserPassword');

        $save = $this->getMockBuilder(Save::class)->disableOriginalConstructor()->getMock();
        $save->expects($this->once())->method('__invoke')->with($this->isInstanceOf(UserInterface::class));

        $container = new Container();
        $container->set('dcs_user.factory', $userFactory);
        $container->set('dcs_user.core.helper.password', $passwordHelper);
        $container->set('dcs_user.manager.save', $save);

        $command = new CreateUserCommand();
        $command->setContainer($container);

        $command->run($input, $output);
    }
}