<?php

namespace Starter\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('owner')
            ->add('isActive', 'checkbox', array('label' => 'Active?'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Starter\UserBundle\Entity\Account'
        ));
    }

    public function getName()
    {
        return 'starter_userbundle_accounttype';
    }
}
