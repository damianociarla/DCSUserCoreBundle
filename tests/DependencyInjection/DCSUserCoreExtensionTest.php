<?php

namespace DCS\User\CoreBundle\Tests\DependencyInjection;

use DCS\User\CoreBundle\DependencyInjection\DCSUserCoreExtension;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DCSUserCoreExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testInvalidConfigurationException()
    {
        $container = new ContainerBuilder();

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessageRegExp('/.*"dcs_user_core.model_class".*/');

        $mock = $this->getMockBuilder(DCSUserCoreExtension::class)->setMethods(['processConfiguration'])->getMock();
        $mock->load([
            'dcs_user_core' => [
                'model_class' => null,
                'repository_service' => 'ACME',
            ],
        ], $container);

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessageRegExp('/.*"dcs_user_core.repository_service".*/');

        $mock = $this->getMockBuilder(DCSUserCoreExtension::class)->setMethods(['processConfiguration'])->getMock();
        $mock->load([
            'dcs_user_core' => [
                'model_class' => 'ACME',
                'repository_service' => null,
            ],
        ], $container);
    }

    public function testLoad()
    {
        $container = new ContainerBuilder();

        $config = [
            'dcs_user_core' => [
                'model_class' => 'ACME_MODEL',
                'repository_service' => 'ACME_REPOSITORY',
            ],
        ];

        $mock = $this->getMockBuilder(DCSUserCoreExtension::class)->setMethods(['processConfiguration'])->getMock();
        $mock->load($config, $container);

        return $container;
    }

    /**
     * @depends testLoad
     */
    public function testContainsParameters(ContainerBuilder $container)
    {
        $this->assertTrue($container->hasParameter('dcs_user.core.model_class'));
        $this->assertEquals('ACME_MODEL', $container->getParameter('dcs_user.core.model_class'));

        $this->assertTrue($container->hasParameter('dcs_user.core.repository_service'));
        $this->assertEquals('ACME_REPOSITORY', $container->getParameter('dcs_user.core.repository_service'));
    }

    /**
     * @depends testLoad
     */
    public function testContainsAliases(ContainerBuilder $container)
    {
        $this->assertTrue($container->hasAlias('dcs_user.manager.save'));
        $this->assertEquals('dcs_user.core.manager.save', $container->getAlias('dcs_user.manager.save'));

        $this->assertTrue($container->hasAlias('dcs_user.manager.delete'));
        $this->assertEquals('dcs_user.core.manager.delete', $container->getAlias('dcs_user.manager.delete'));

        $this->assertTrue($container->hasAlias('dcs_user.factory'));
        $this->assertEquals('dcs_user.core.service.user_factory', $container->getAlias('dcs_user.factory'));
    }

    /**
     * @depends testLoad
     */
    public function testContainsLoadedXMLFiles(ContainerBuilder $container)
    {
        $this->assertCount(3, $resources = $container->getResources());

        /** @var FileResource $resource */
        foreach ($resources as $resource) {
            $this->assertContains(pathinfo($resource->getResource(), PATHINFO_BASENAME), ['helper.xml','manager.xml','service.xml']);
        }
    }
}