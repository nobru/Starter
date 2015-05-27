<?php

namespace Starter\BillingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('price')
            ->add('payDate')
            ->add('paidAt')
            ->add('status')
            ->add('billing')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Starter\BillingBundle\Entity\Invoice'
        ));
    }

    public function getName()
    {
        return 'starter_billingbundle_invoicetype';
    }
}
