<?php

namespace Sbyaute\FrontBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @see http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class FrontExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $container->setParameter('front.app_title', $config['app_title']);
        $container->setParameter('front.app_subtitle', $config['app_subtitle']);
        $container->setParameter('front.app_version', $config['app_version']);
        $container->setParameter('front.logout', $config['logout']);
        $container->setParameter('front.homepage', $config['homepage']);
        $container->setParameter('front.menu_external_link', $config['menu_external_link']);
    }

    public function prepend(ContainerBuilder $container): void
    {
        $config = ['error_controller' => 'Sbyaute\\FrontBundle\\Controller\\ErrorController::show'];
        if ('prod' === $container->getParameter('kernel.environment')) {
            $config = ['error_controller' => 'Sbyaute\\FrontBundle\\Controller\\ErrorController::showProd'];
        }
        $container->prependExtensionConfig('framework', $config);

        $container->prependExtensionConfig('twig', [
            'form_themes' => ['bootstrap_5_layout.html.twig'],
        ]);
    }
}
