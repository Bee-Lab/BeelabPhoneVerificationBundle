<?php

namespace Beelab\PhoneVerificationBundle\Tests\DependencyInjection;

use Beelab\PhoneVerificationBundle\DependencyInjection\BeelabPhoneVerificationExtension;
use PHPUnit_Framework_TestCase;

class BeelabPhoneVerificationExtensionTest extends PHPUnit_Framework_TestCase
{
    public function testLoadFailure()
    {
        $container = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ContainerBuilder')->disableOriginalConstructor()->getMock();
        $extension = $this->getMockBuilder('Beelab\\PhoneVerificationBundle\\DependencyInjection\\BeelabPhoneVerificationExtension')->getMock();

        $extension->load([[]], $container);
    }

    public function testLoadSetParameters()
    {
        $container = $this->getMockBuilder('Symfony\\Component\\DependencyInjection\\ContainerBuilder')->disableOriginalConstructor()->getMock();
        $parameterBag = $this->getMockBuilder('Symfony\Component\DependencyInjection\ParameterBag\\ParameterBag')->disableOriginalConstructor()->getMock();

        $parameterBag->expects($this->any())->method('add');

        $container->expects($this->any())->method('getParameterBag')->will($this->returnValue($parameterBag));

        $extension = new BeelabPhoneVerificationExtension();
        $configs = [
            ['adapter' => 'skebby'],
            ['phone_class' => 'foo'],
            ['phone_manager_class' => 'foo'],
            ['success_route' => 'foo'],
            ['code_form_type' => 'foo'],
            ['phone_form_type' => 'foo'],
            ['phone_number_regex' => '/[\d]+/'],
            ['layout' => 'bar'],
        ];
        $extension->load($configs, $container);
    }
}
