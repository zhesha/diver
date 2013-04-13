<?php

namespace Diver\PriceLisrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('name_ru')
            ->add('fullname')
            ->add('category')
            ->add('partnumber')
            ->add('manufacturer')
            ->add('price')
            ->add('garant')
            ->add('ostatok_lviv')
            ->add('ostatok_kyyiv')
            ->add('ostatok_odesa')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diver\PriceLisrBundle\Entity\Items'
        ));
    }

    public function getName()
    {
        return 'diver_pricelisrbundle_itemstype';
    }
}
