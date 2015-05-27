<?php

namespace Starter\PlanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PeriodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('qtd')
            ->add('type', 'choice', array('choices' => array('D' => 'Day', 'M' => 'Month', 'Y' => 'Year')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Starter\PlanBundle\Entity\Period'
        ));
    }

    public function getName()
    {
        return 'admin_planbundle_periodtype';
    }
}
