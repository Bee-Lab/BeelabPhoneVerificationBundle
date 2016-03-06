<?php

namespace Beelab\PhoneVerificationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints;

class VerifyPhoneType extends AbstractType
{
    /**
     * @var string
     */
    protected $regex;

    /**
     * @param string $regex
     */
    public function __construct($regex)
    {
        $this->regex = $regex;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', $this->isLegacy() ? 'text' : 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'constraints' => [new Constraints\NotBlank(), new Constraints\Regex(['pattern' => $this->regex])],
                'attr' => ['maxlength' => 16],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return $this->getName();
    }

    /**
     * BC for Symfony < 3.0.
     */
    public function getName()
    {
        return 'beelab_verify_phone';
    }

    /**
     * @return bool
     */
    private function isLegacy()
    {
        return !method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix');
    }
}
