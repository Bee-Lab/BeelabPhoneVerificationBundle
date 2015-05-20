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
            ->add('number', 'text', [
                'constraints' => [new Constraints\NotBlank(), new Constraints\Regex(['pattern' => $this->regex])],
                'attr'        => ['maxlength' => 16],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'beelab_verify_phone';
    }
}
