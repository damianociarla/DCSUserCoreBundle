<?php

namespace DCS\User\CoreBundle\Tests\DependencyInjection\Compiler;

use DCS\User\CoreBundle\DependencyInjection\Compiler\RepositoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class RepositoryCompilerPassTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessMethodThrowServiceNotFoundException()
    {
        $this->expectException(ServiceNotFoundException::class);

        $container = new ContainerBuilder();
        $container->setParameter('dcs_user.core.repository_service', 'acme_service');

        $repositoryCompilerPass = new RepositoryCompilerPass();
        $repositoryCompilerPass->process($container);
    }

    public function testAliasExists()
    {
        $container = new ContainerBuilder();
        $container->setParameter('dcs_user.core.repository_service', 'acme_repository_service');
        $container->set('acme_repository_service', (object)'i_am_a_repository_service');

        $repositoryCompilerPass = new RepositoryCompilerPass();
        $repositoryCompilerPass->process($container);

        $this->assertTrue($container->hasAlias('dcs_user.repository'));
        $this->assertEquals('acme_repository_service', $container->getAlias('dcs_user.repository'));
    }
}