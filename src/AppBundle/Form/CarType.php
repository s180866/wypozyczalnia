<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', [
                'label' => 'Nazwa'
            ])
            ->add('year', 'integer', [
                'label' => 'Rok produkcji'
            ])
            ->add('amount', 'integer', [
                'label' => 'Ilość dostępnych'
            ])
            ->add('photo', 'vich_image', [
                'label' => 'Zdjęcie',
                'required' => false
            ])
            ->add('price', null, [
                'label' => 'Koszt'
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Car'
        ));
    }

    public function getName()
    {
        return 'appbundle_car';
    }
}
