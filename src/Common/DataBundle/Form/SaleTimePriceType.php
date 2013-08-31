<?php

namespace Common\DataBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaleTimePriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add('sale_price')
            ->add('local_price')
            ->add('currency_price')
            ->add('currency_rate')
            ->add('price_date')
            ->add('created_at')
            ->add('updated_at')
            ->add('product')
            ->add('customer')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Common\DataBundle\Entity\SaleTimePrice'
        ));
    }

    public function getName()
    {
        return 'common_databundle_saletimepricetype';
    }
}
