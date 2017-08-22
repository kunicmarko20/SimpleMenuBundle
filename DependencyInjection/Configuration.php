<?php

namespace KunicMarko\SimpleMenuBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('simple_menu');
        $rootNode
            ->children()
                ->scalarNode('render_template')
                    ->defaultValue('SimpleMenuBundle:Menu:render.html.twig')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
