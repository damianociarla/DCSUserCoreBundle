<?php

namespace DCS\User\CoreBundle\Tests\DependencyInjection\Command;

use DCS\User\CoreBundle\Command\CreateUserCommand;
use DCS\User\CoreBundle\Helper\PasswordHelperInterface;
use DCS\User\CoreBundle\Manager\Save;
use DCS\User\CoreBundle\Model\UserInterface;
use DCS\User\CoreBundle\Service\UserFactoryInterface;
use DCS\User\CoreBundle\Tests\TestUser;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
        $input = $this->getMockBuilder(InputInterface::class)->getMock();
        $input->expects($this->at(0))->method('getOption')->willReturn('acme');
        $input->expects($this->at(1))->method('getOption')->willReturn('password');

        $output = $this->getMockBuilder(OutputInterface::class)->getMock();

        $userFactory = $this->getMockBuilder(UserFactoryInterface::class)->getMock();
        $userFactory->expects($this->once())->method('create')->willReturn(new TestUser());

        $passwordHelper = $this->getMockBuilder(PasswordHelperInterface::class)->getMock();
        $passwordHelper->expects($this->once())->method('updateUserPassword');

        $save = $this->getMockBuilder(Save::class)->disableOriginalConstructor()->getMock();
        $save->expects($this->once())->method('__invoke')->with($this->isInstanceOf(UserInterface::class));

        $container = $this->getMockBuilder(ContainerInterface::class)->getMock();
        $container->expects($this->at(0))->method('get')->with('dcs_user.factory')->willReturn($userFactory);
        $container->expects($this->at(1))->method('get')->with('dcs_user.core.helper.password')->willReturn($passwordHelper);
        $container->expects($this->at(2))->method('get')->with('dcs_user.manager.save')->willReturn($save);

        $command = new CreateUserCommand();
        $command->setContainer($container);

        $command->run($input, $output);
    }
}