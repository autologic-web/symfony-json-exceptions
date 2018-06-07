<?php

namespace Autologic\JSONExceptions\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AutologicJSONExceptionsExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('autologic_json_exceptions.pretty_dev', $config['pretty_dev']);
        $container->setParameter(
            'autologic_json_exceptions.env',
            $container->getParameter('kernel.environment')
        );
    }
}
