<?php

namespace Diver\PriceLisrBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('name_ru')
            ->add('parent')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Diver\PriceLisrBundle\Entity\Categories'
        ));
    }

    public function getName()
    {
        return 'diver_pricelisrbundle_categoriestype';
    }
}
