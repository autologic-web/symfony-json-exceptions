<?php

namespace Autologic\JSONExceptions\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('autologic_json_exceptions');

        $rootNode
            ->children()->booleanNode('pretty_dev')->defaultFalse()->end()
        ->end();

        return $treeBuilder;
    }
}
