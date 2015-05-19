<?php

namespace Beelab\PhoneVerificationBundle\Form\Type;

use Beelab\PhoneVerificationBundle\Validator\Constraints\Code;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints;

class VerifyCodeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', 'text', [
                'constraints' => [new Constraints\NotBlank(), new Constraints\Length(['max' => 6])],
                'attr'        => ['maxlength' => 6],
            ])
            ->add('number', 'hidden', ['data' => $options['number']])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'number'      => '',
            'constraints' => [new Code()],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'beelab_verify_code';
    }
}
