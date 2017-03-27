<?php

namespace Starter\BillingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InvoiceStatusType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add(
                'isPaid',
                'choice',
                [
                    'expanded' => false,
                    'label' => 'Is paid?',
                    'choices' => [
                        '0' => 'No',
                        '1' => 'Yes'
                    ]
                ]
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Starter\BillingBundle\Entity\InvoiceStatus'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'starter_billingbundle_invoicestatus';
    }
}
