<?php

namespace Beelab\PhoneVerificationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Take the configured adapter and inject the adapter service in SMS Manager service.
 * Also, inject the needed service in the adapter itself.
 */
class AdapterCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $senderDefinition = $container->getDefinition('beelab_phone_verification.sender');
        $adapter = $container->getParameter('beelab_phone_verification.adapter');
        switch ($adapter) {
            case 'skebby':
               if (!$container->hasDefinition('skebby')) {
                   throw new ServiceNotFoundException('skebby');
               }
               $skebbyDefinition = $container->getDefinition('beelab_phone_verification.adapter.skebby');
               $skebbyDefinition->replaceArgument(0, $container->getDefinition('skebby'));
               $senderDefinition->replaceArgument(0, $skebbyDefinition);
        }
    }
}
