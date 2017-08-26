<?php

namespace KunicMarko\SimpleMenuBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Class SimpleMenuExtension
 *
 * @package KunicMarko\SimpleMenuBundle\DependencyInjection
 */
class SimpleMenuExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('simple_menu.render.template', $config['render']['template']);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('twig.xml');
        $loader->load('admin.xml');
        $loader->load('doctrine_extensions.xml');
    }
}
