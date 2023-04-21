<?php

namespace Sbyaute\FrontBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Retourne la configuration en fonction du mode d'exécution du PHPK.
     *
     * @return type
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('front');

        $rootNode = method_exists(TreeBuilder::class, 'getRootNode') ? $treeBuilder->getRootNode() : $treeBuilder->root('front');

        $rootNode->children()
            ->scalarNode('app_title')
                ->cannotBeEmpty()
                ->defaultValue('Titre de l\'application')
                ->info('Titre de l\'application (ex: \'<span class="am-coul-turquoise">lorem ipsum</span> AM\'). Affiché dans l\'entête.')
            ->end()
            ->scalarNode('app_subtitle')
                ->defaultValue('')
                ->info('Sous-titre de l\'application. Affiché dans l\'entête.')
            ->end()
            ->scalarNode('app_version')
                ->defaultValue('')
                ->info('Version de l\'application (ex: \'1.2.3\'). Affichée sous le menu principal.')
            ->end()
            ->booleanNode('logout')
                ->defaultValue(false)
                ->info('Indique si un lien de déconnexion doit être affiché ou non.')
            ->end()
            ->scalarNode('homepage')
                ->defaultValue('accueil')
                ->info('Nom de la route vers la page d\'accueil.')
            ->end()
            ->booleanNode('menu_external_link')
                ->defaultValue(true)
                ->info('Signale par une icône, les liens externes présents dans le menu.')
            ->end()
        ;

        return $treeBuilder;
    }
}
