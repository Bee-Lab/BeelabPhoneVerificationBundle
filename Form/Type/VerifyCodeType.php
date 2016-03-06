<?php

namespace Beelab\PhoneVerificationBundle\Form\Type;

use Beelab\PhoneVerificationBundle\Validator\Constraints\Code;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints;

class VerifyCodeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', $this->isLegacy() ? 'text' : 'Symfony\Component\Form\Extension\Core\Type\TextType', [
                'constraints' => [new Constraints\NotBlank(), new Constraints\Length(['max' => 6])],
                'attr' => ['maxlength' => 6],
            ])
            ->add('number', $this->isLegacy() ? 'hidden' : 'Symfony\Component\Form\Extension\Core\Type\HiddenType', ['data' => $options['number']])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'number' => '',
            'constraints' => [new Code()],
        ]);
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
        return 'beelab_verify_code';
    }

    /**
     * @return bool
     */
    private function isLegacy()
    {
        return !method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix');
    }
}
