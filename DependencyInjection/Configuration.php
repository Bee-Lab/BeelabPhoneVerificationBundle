<?php

namespace Beelab\PhoneVerificationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('beelab_phone_verification');

        $rootNode
            ->children()
                ->scalarNode('adapter')
                    ->isRequired()
                    ->validate()
                    ->ifNotInArray(array('skebby'))
                        ->thenInvalid('Invalid value "%s"')
                    ->end()
                ->end()
                ->scalarNode('phone_class')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('phone_manager_class')
                    ->cannotBeEmpty()
                    ->defaultValue('Beelab\PhoneVerificationBundle\Manager\PhoneManager')
                ->end()
                ->scalarNode('success_route')
                    ->cannotBeEmpty()
                    ->defaultValue('homepage')
                ->end()
                ->scalarNode('code_form_type')
                    ->cannotBeEmpty()
                    ->defaultValue('Beelab\PhoneVerificationBundle\Form\Type\VerifyCodeType')
                ->end()
                ->scalarNode('phone_form_type')
                    ->cannotBeEmpty()
                    ->defaultValue('Beelab\PhoneVerificationBundle\Form\Type\VerifyPhoneType')
                ->end()
                ->scalarNode('phone_number_regex')
                    ->cannotBeEmpty()
                    ->defaultValue('/^[0-9]{6,17}$/')
                ->end()
                ->scalarNode('layout')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
