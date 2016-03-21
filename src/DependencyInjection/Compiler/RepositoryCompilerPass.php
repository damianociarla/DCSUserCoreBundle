<?php

namespace DCS\User\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class RepositoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $repositoryService = $container->getParameter('dcs_user.core.repository_service');

        if (!$container->has($repositoryService)) {
            throw new ServiceNotFoundException($repositoryService);
        }

        $container->setAlias('dcs_user.repository', $repositoryService);
    }
}
