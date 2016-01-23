<?php

namespace AppBundle\Form;

use AppBundle\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status', 'choice', [
                'choices' => Orders::getStatuses()
            ])
            ->add('car', null, [
                'required' => true
            ])
            ->add('user', null, [
                'required' => true
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'data_class' => 'AppBundle\Entity\Orders'
        ));
    }

    public function getName()
    {
        return 'appbundle_orders';
    }
}
