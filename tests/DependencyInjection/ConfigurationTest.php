<?php

namespace DCS\User\CoreBundle\Tests\DependencyInjection;

use DCS\User\CoreBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\ScalarNode;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Configuration
     */
    private $configuration;

    protected function setUp()
    {
        $this->configuration = new Configuration();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(ConfigurationInterface::class, $this->configuration);
    }

    public function testGetConfigTreeBuilder()
    {
        $this->assertInstanceOf(TreeBuilder::class, $this->configuration->getConfigTreeBuilder());
    }

    public function testRootNodeNameBuilder()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();
        $this->assertEquals('dcs_user_core', $treeBuilder->buildTree()->getName());
    }

    public function testModelClassNode()
    {
        $treeBuilder = $this->configuration->getConfigTreeBuilder();

        /** @var \Symfony\Component\Config\Definition\ArrayNode $tree */
        $tree = $treeBuilder->buildTree();

        $this->assertCount(2, $children = $tree->getChildren());

        $this->assertArrayHasKey('model_class', $children);
        $this->assertInstanceOf(ScalarNode::class, $children['model_class']);

        $this->assertArrayHasKey('repository_service', $children);
        $this->assertInstanceOf(ScalarNode::class, $children['repository_service']);
    }
}