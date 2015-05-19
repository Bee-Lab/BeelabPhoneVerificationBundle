<?php

namespace Beelab\PhoneVerificationBundle\Twig;

use Twig_Extension;

/**
 * This extension is used to register some global variables.
 */
class BeelabPhoneVerificationTwigExtension extends Twig_Extension
{
    /**
     * @var string
     */
    protected $layout;

    /**
     * @param string $layout layout name (for "extends" statement)
     */
    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    /**
     * {@inheritdoc}
     */
    public function getGlobals()
    {
        return [
            'beelab_phone_verification_layout' => $this->layout,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'beelab_phone_verification_twig_extension';
    }
}
