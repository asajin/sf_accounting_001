<?php

namespace Common\DataBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TimePriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('local_price')
            ->add('currency_price')
            ->add('currency_rate')
            ->add('stock')
            ->add('price_date')
            ->add('created_at')
            ->add('updated_at')
            ->add('supplier')
            ->add('product')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Common\DataBundle\Entity\TimePrice'
        ));
    }

    public function getName()
    {
        return 'common_databundle_timepricetype';
    }
}
