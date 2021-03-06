<?php

namespace Metaclass\AuthenticationGuardBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Merges configuration from the app/config files.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('metaclass_authentication_guard');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('db_connection')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('name')->defaultValue('default')->end()
                    ->end()
                ->end()
                ->arrayNode('ui')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('dateTimeFormat')->defaultValue('SHORT')->end()
                        ->arrayNode('statistics')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('template')->defaultValue('MetaclassAuthenticationGuardBundle:Guard:statistics.html.twig')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('tresholds_governor_params')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('counterDurationInSeconds')->defaultValue(180)->end()
                        ->scalarNode('blockUsernamesFor')->defaultValue('25 minutes')->end()
                        ->scalarNode('limitPerUserName')->defaultValue(3)->end()
                        ->scalarNode('blockIpAddressesFor')->defaultValue('17 minutes')->end()
                        ->scalarNode('limitBasePerIpAddress')->defaultValue(10)->end()
                        ->scalarNode('allowReleasedUserOnAddressFor')->defaultValue('30 days')->end()
                        ->scalarNode('releaseUserOnLoginSuccess')->defaultValue(false)->end()
                        ->scalarNode('keepCountsFor')->defaultValue('4 days')->end()
                        ->scalarNode('fixedExecutionSeconds')->defaultValue('0.1')->end()
                        ->scalarNode('randomSleepingNanosecondsMax')->defaultValue('99999')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
