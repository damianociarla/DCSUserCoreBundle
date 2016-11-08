<?php

namespace DCS\User\CoreBundle\Tests;

use DCS\User\CoreBundle\DCSUserCoreBundle;
use DCS\User\CoreBundle\DependencyInjection\Compiler\RepositoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DCSUserCoreBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildAddCompilerPass()
    {
        $containerBuilder = $this->getMockBuilder(ContainerBuilder::class)->getMock();
        $containerBuilder->expects($this->once())
            ->method('addCompilerPass')
            ->with($this->isInstanceOf(RepositoryCompilerPass::class));

        $bundle = new DCSUserCoreBundle();
        $bundle->build($containerBuilder);
    }
}