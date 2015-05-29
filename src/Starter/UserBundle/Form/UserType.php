<?php

namespace Starter\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('name')
            ->add('password', 'password')
            ->add('email')
            ->add('isActive')
            ->add('roles')
            ->add('accounts')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Starter\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'starter_userbundle_usertype';
    }
}
