<?php

namespace DCS\User\CoreBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class DCSUserCoreExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('dcs_user.core.model_class', $config['model_class']);
        $container->setParameter('dcs_user.core.repository_service', $config['repository_service']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('helper.xml');

        $loader->load('manager.xml');
        $container->setAliases([
            'dcs_user.manager.save' => 'dcs_user.core.manager.save',
            'dcs_user.manager.delete' => 'dcs_user.core.manager.delete',
        ]);

        $loader->load('service.xml');
        $container->setAlias('dcs_user.factory', 'dcs_user.core.service.user_factory');
    }
}