<?php

namespace Beelab\PhoneVerificationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints;

class VerifyPhoneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number', 'text', [
                'constraints' => [new Constraints\NotBlank(), new Constraints\Length(['min' => 7, 'max' => 16])],
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
