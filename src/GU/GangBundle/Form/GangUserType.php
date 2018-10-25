<?php

namespace GU\GangBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GangUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('role', TextType::class)
            ->add('user', EntityType::class, [
                'class' => 'UserBundle:User',
                'choice_label' => 'id',
            ])
            ->add('gang', EntityType::class, [
                'class' => 'GangBundle:Gang',
                'choice_label' => 'id'
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Greet::class,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "greet";
    }
}