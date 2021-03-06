<?php

namespace GU\FriendshipBundle\Form;

use GU\FriendshipBundle\Entity\Friendship;
use GU\GreetBundle\Entity\Greet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FriendshipType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => 'UserBundle:User',
                'choice_label' => 'id',
            ])
            ->add('friend', EntityType::class, [
                'class' => 'UserBundle:User',
                'choice_label' => 'id',
            ])
            ->add('status', TextType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Friendship::class,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "friendship";
    }
}