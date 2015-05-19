<?php

namespace Beelab\PhoneVerificationBundle;

use Beelab\PhoneVerificationBundle\DependencyInjection\Compiler\AdapterCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BeelabPhoneVerificationBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AdapterCompilerPass());
    }
}
