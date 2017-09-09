<?php

namespace KunicMarko\SimpleMenuBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('simple_menu');
        $rootNode
            ->children()
                ->arrayNode('template')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('render')
                            ->defaultValue('SimpleMenuBundle:Menu:render.html.twig')
                        ->end()
                    ->end()
            ->end();

        return $treeBuilder;
    }
}
