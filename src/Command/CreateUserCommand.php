<?php

namespace DCS\User\CoreBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('dcs_user:core:create_user')
            ->setDescription('Create new User')
            ->addOption('username', null, InputOption::VALUE_REQUIRED)
            ->addOption('password', null, InputOption::VALUE_REQUIRED);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getOption('username');
        $password = $input->getOption('password');

        $user = $this->getContainer()->get('dcs_user.factory')->create();
        $user->setUsername($username);

        $this->getContainer()->get('dcs_user.core.helper.password')->updateUserPassword($user, $password);
        $this->getContainer()->get('dcs_user.manager.save')->__invoke($user);
    }
}
