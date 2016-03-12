<?php

namespace DCS\User\CoreBundle;

use DCS\User\CoreBundle\DependencyInjection\Compiler\RepositoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DCSUserCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new RepositoryCompilerPass());
    }
}